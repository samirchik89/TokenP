<?php

namespace App\Console\Commands;

use App\DepositHistory;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ETHTransactionCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ethtransaction:apistatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eth Transaction API Check';

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
            $date = new \DateTime();
            $date->modify('-2 hours');
            $formatted_date = $date->format('Y-m-d H:i:s');
            $users          = User::where('last_login_at', '>', $formatted_date)->where('verified', 1)->get();
            // $users          = User::where('verified',1)->get();
            // dd($users);
            if (!empty($users)) {
                foreach ($users as $key => $value) {
                    $eth_address = $value->eth_address;
                    //$eth_address = '0x7982505Ac81E75De6388DDB127bf10F607101766';

                    if (empty($eth_address)) {
                        continue;
                    }

                    $eth_balance = $this->checkBalance($eth_address);

                    logger()->info('user: ' . $value->email . ', address: ' . $eth_address . ', balance: ' . $eth_balance);

                    if ($eth_balance <= 0) {
                        continue;
                    }

                    $value->ETH = $eth_balance;
                    $value->save();

                    $client      = new Client();
                    $res         = $client->get(env('COIN_URL') . '/api?apikey=' . env("ETHERSCANKEY") . '&module=account&action=txlist&address=' . $eth_address . '&page=1&offset=20&sort=desc');
                    $transaction = json_decode($res->getBody(), true);
                    // logger()->info(['transaction' => $transaction]);

                    // dd($transaction);
                    foreach ($transaction['result'] as $item) {
                        if (strtolower($item['to']) == strtolower($value->eth_address)) {
                            $hash    = $item['hash'];
                            $history = DepositHistory::wheretxn_hash($hash)->where('user_id', $value->id)->first();
                            if (!$history) {
                                $eth_amount = $item['value'] / 1000000000000000000;

                                $Transaction           = new DepositHistory;
                                $Transaction->user_id  = $value->id;
                                $Transaction->amount   = $eth_amount;
                                $Transaction->type     = 'MATIC';
                                $Transaction->address  = $item['to'];
                                $Transaction->txn_hash = $hash;
                                $Transaction->status   = 'success';
                                $Transaction->save();
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            logger()->info(['eth_status' => $th]);
            DB::connection()->disconnect();
        } finally {
            DB::connection()->disconnect();
        }

        return 0;
    }

    public function checkBalance($eth_address)
    {
        $ethbalance = 0;
        try {
            $client      = new Client();
            $res         = $client->get(env('COIN_URL') . '/api?apikey=' . env("ETHERSCANKEY") . '&module=account&action=balance&address=' . $eth_address . '&tag=latest');

            $eth_balance = json_decode($res->getBody(), true);
            if (isset($eth_balance['result'])) {
                $balance    = $eth_balance['result'];
                $ethbalance = $balance / 10 ** 18;
            }
            return $ethbalance;
        } catch (\Throwable $th) {
            return $ethbalance;
        }
    }
}
