<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CoinType;
use GuzzleHttp\Client;
use Setting;
use App\User;
use App\DepositHistory;

class ETHTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eth:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to check ETH transaction status';

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
        $date = new \DateTime();
        $date->modify('-2 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $users = User::where('last_login_at', '>', $formatted_date)->get();
        if (!empty($users)) {
            foreach ($users as $key => $value) {
                /**
                 * Used to update ETH Transaction
                 */

                $client = new Client();
                $headers = [
                    'Content-Type' => 'application/json',
                ];
                $body = ["jsonrpc" => "2.0", "method" => "eth_blockNumber", "params" => [], "id" => 1];
                $url = env('ETH_URL');
                $res = $client->post($url, [
                    'headers' => $headers,
                    'body' => json_encode($body),
                ]);
                $getblock = json_decode($res->getBody(), true);
                if (isset($getblock['result']) && $getblock['result'] != '') {
                    $last_block = hexdec($getblock['result']);
                    $start_block = $last_block - 200;
                    for ($i = $start_block; $i <= $last_block; $i++) {
                        $blocknumber = '0x' . dechex($i);
                        $body = ["method" => "eth_getBlockByNumber", "params" => [$blocknumber, true], "id" => 1];
                        $url = env('ETH_URL');
                        $res = $client->post($url, [
                            'headers' => $headers,
                            'body' => json_encode($body),
                        ]);
                        $blocks = json_decode($res->getBody(), true);
                        $blocks = $blocks['result'];
                        if (!empty($blocks) && !empty($blocks['transactions'])) {
                            foreach ($blocks['transactions'] as $transaction) {
                                if ($value->eth_address != '') {
                                    if ($transaction['to'] != null) {
                                        if (strtolower($transaction['to']) == strtolower($value->eth_address)) {
                                            $eth_amount = hexdec($transaction['value']) / 1000000000000000000;
                                            if ($eth_amount != 0) {
                                                $exists = DepositHistory::where(['address' => $value->eth_address, 'txn_hash' => $transaction['hash']])->first();
                                                if (empty($exists)) {
                                                    if ($transaction['to'] != '') {
                                                        $this->Transaction($value->id, $transaction['hash'], $eth_amount, $transaction['to'], 'MATIC');
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Used to Insert Transacation
     */
    public function Transaction($id, $tranx_id, $amount_new, $address, $cointype)
    {
        $user = User::find($id);
        if ($address != '' && !empty($address)) {
            if ($cointype == 'MATIC') {
                $payment_mode = $cointype;
                $user->ETH += $amount_new;
                $user->save();
                $status = 'success';

                $client = new Client();
                $headers = [
                    'Content-Type' => 'application/json',
                ];
                $body = ["method" => "personal_newAccount", "params" => [$user->email], "id" => 1];

                $url = env('ETH_URL');
                $res = $client->post($url, [
                    'headers' => $headers,
                    'body' => json_encode($body),
                ]);
                $eth_address = json_decode($res->getBody(), true);

                if (isset($eth_address['result']))
                    $eth_address = $eth_address['result'];
                else
                    $eth_address = '';
                $user->update(['eth_address' => $eth_address]);
            }

            $Transaction = new DepositHistory;
            $Transaction->user_id = $user->id;
            $Transaction->amount = $amount_new;
            $Transaction->type = $cointype;
            $Transaction->address = $address;
            $Transaction->txn_hash = $tranx_id;
            $Transaction->status = $status;
            $Transaction->save();
        }
    }
}
