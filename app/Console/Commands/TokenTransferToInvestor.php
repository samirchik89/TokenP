<?php

namespace App\Console\Commands;

use App\User;
use App\UserContract;
use App\UserTokenTransaction;
use GuzzleHttp\Client;
use App\UserToken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TokenTransferToInvestor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:investortransfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Token transfer to investor';

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
            $user_tokens = UserTokenTransaction::where('status', 2)->get();
            foreach ($user_tokens as $token) {
                $user = User::where('id', $token->user_id)->first();
                if (!$user) {
                    continue;
                }

                $user_contract = (new UserContract)->getUserContract($token->user_contract_id);

                if (!$user_contract) {
                    continue;
                }

                $issuer_user = User::where('id', $user_contract->user_id)->first();

                if (!$issuer_user) {
                    continue;
                }

                $client  = new Client();
                $headers = ['Content-Type' => 'application/json',];
                $url     = env('BASE_NODE_URL') . '/getKey';
                $res     = $client->post($url, [
                    'headers'     => $headers,
                    'body' => json_encode([
                        'address'    => $issuer_user->eth_address,
                        'string' => $issuer_user->email,
                    ]),
                ]);
                $res     = json_decode($res->getBody(), true);

                // logger()->info(["res" => $res]);
                if (isset($res['status']) && $res['status'] == 'success') {
                    // logger()->info(["key" => $res['key']]);
                    $eth_pvt_key = $res['key'];

                    $url     = env('BASE_NODE_URL', 'http://localhost:3000') . '/transfer';
                    // logger()->info(['url' => $url]);
                    $client  = new Client();
                    $headers = ['Content-Type' => 'application/json',];
                    $body    = [
                        'contract_address' => $user_contract->contract_address,
                        'to'               => $user->eth_address,
                        'amount'           => (string)$token->total_token,
                        'senderAddress'    => $issuer_user->eth_address,
                        'key' => $eth_pvt_key,
                        'decimal'          => (int)$user_contract->decimal,
                        'chain' => $token->payment_type,
                    ];
                    $res     = $client->post($url, [
                        'headers' => $headers,
                        'body'    => json_encode($body),
                    ]);
                    // logger()->info(['res' => $res]);
                    $details = json_decode($res->getBody(), true);
                    // logger()->info(['details', $details]);

                    if (isset($details['status']) && $details['status'] == 'success') {
                        $user_token = UserToken::where('user_contract_id', $token->user_contract_id)->first();
                        if (!is_null($user_token)) {
                            $user_token->token_acquire = $user_token->token_acquire + $token->number_of_token;
                            $user_token->save();
                        } else {
                            $user_token                   = new UserToken;
                            $user_token->token_acquire    = $token->number_of_token ?? 0;
                            $user_token->user_id          = $user->id;
                            $user_token->user_contract_id = $token->user_contract_id;
                            $user_token->save();
                        }
                       
                        $token->token_txn_hash = $details['txHash'];
                        $token->status = 1;
                        $token->save();
                    }else{
                        // $user_contract->tokenbalance =  price_format($user_contract->tokenbalance +  $token->number_of_token ?? 0, 6);
                        // $user_contract->save();
                    }
                }
            }
        } catch (\Throwable $e) {
            logger()->info(['mess' => $e]);
            DB::connection()->disconnect();
        } finally {
            DB::connection()->disconnect();
        }
    }
}
