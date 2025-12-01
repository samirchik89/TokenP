<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\IssuerTokenRequest;
use App\User;
use App\UserContract;
use Setting;
use GuzzleHttp\Client;

class TokenDeployStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploying the token in backend';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $tokensTodeploy = IssuerTokenRequest::where('token_deploy_status', 0)->get();
            if (isset($tokensTodeploy)) {
                foreach ($tokensTodeploy as $tokendeploy) {
                    $token_name = $tokendeploy->name;
                    $token_symbol = $tokendeploy->symbol;
                    $token_value = $tokendeploy->usdvalue;
                    $token_supply = $tokendeploy->supply;
                    $token_decimal = $tokendeploy->decimal;
                    $security_type = $tokendeploy->security_type;
                    $user_id = $tokendeploy->user_id;

                    $user = User::findOrFail($user_id);
                    $email = $user->email;

                    $address = $user->eth_address;

                    $contractABI = Setting::get('contract_abi');
                    $byteCode = Setting::get('byte_code');

                    $client = new Client;
                    $headers = [
                        'Content-Type' => 'application/json',
                    ];
                    $url = env('BASE_NODE_URL') . "/getKey";
                    $res = $client->post($url, [
                        'headers' => $headers,
                        'body' => json_encode(['address' => $user->eth_address, 'string' => $user->email]),
                    ]);
                    $res = json_decode($res->getBody(), true);
                    if ($res['status'] == true)
                        $eth_pvt_key = $res['key'];
                    else
                        return back()->with('flash_error', 'Something went wrong');
                    $client = new Client;

                    $headers = [
                        'Content-Type' => 'application/json',
                    ];

                    $url = env('ETH_NODE_URL') . "/deploy";
                    $body = ["senderPrivateKey" => $eth_pvt_key, "senderAddress" => $address, "manager" => $address, "resolver" => $address, "owner" => $address, "name" => $token_name, "symbol" => $token_symbol, "totalSupply" => $token_supply, "decimals" => $token_decimal];

                    $res = $client->post($url, [
                        'headers' => $headers,
                        'body' => json_encode($body),
                    ]);
                    $details = json_decode($res->getBody(), true);
                    // \Log::info($details);
                    if (isset($details['status'])) {
                        if ($details['status'] == 'success') {
                            $token = new UserContract;
                            $token->property_id = $tokendeploy->property_id;
                            $token->user_id = $user->id;
                            $token->issued_by = $tokendeploy->user_id;
                            $token->tokenname = $tokendeploy->name;
                            $token->tokensymbol = $tokendeploy->symbol;
                            $token->tokenvalue = $tokendeploy->usdvalue;
                            $token->tokensupply = $tokendeploy->supply;
                            $token->contract_address = $details['contract_address'];
                            $token->decimal = $tokendeploy->decimal;
                            $token->token_image = $tokendeploy->token_image;
                            $token->banner_image = $tokendeploy->banner_image;
                            $token->token_type = $tokendeploy->token_type;
                            $token->status = 1;
                            $token->save();
                            $tokendeploy->token_deploy_status = 1;
                            $tokendeploy->save();
                            \Log::info('Token deployed successfully in cron');
                        }
                    }
                }
            }
        } catch (Exception $e) {
            \Log::critical("Issue in token deploy cron tab " . $e);
            \Log::info($e);
        }
    }
}
