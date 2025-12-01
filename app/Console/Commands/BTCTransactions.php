<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CoinType;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Setting;
use App\User;
use App\DepositHistory;

class BTCTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'btc:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to check BTC transaction status';

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
                 * Used to update BTC Transaction
                 */
                $details = $this->btchistory($value->btc_address);
                if (!empty($details)) {
                    $this->Transaction($value->id, $details['txid'], $details['amount'], $details['address'], 'BTC');
                }
            }
        }

        DB::connection()->disconnect();
    }
    /**
     * Used to Insert Transacation
     */
    public function Transaction($id, $tranx_id, $amount_new, $address, $cointype)
    {
        $user = User::find($id);
        if ($cointype == 'BTC') {
            $payment_mode = $cointype;
            $user->BTC += $amount_new;
            $user->save();
            $status = 'pending';

            $param = ["adminaccount"];

            $body = ['params' => $param, 'method' => 'getnewaddress'];
            $btc_address = $this->npmcurl($body);
            $user->update(['btc_address' => $btc_address]);
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
    /**
     * Transaction History for BTC
     */
    public function btchistory($tx_id)
    {
        $name = "adminaccount";
        $param = [$tx_id];
        $body = [
            'params' => $param,
            'method' => 'getreceivedbyaddress',
        ];
        $curldata = $this->npmcurl($body);

        $details = $curldata;

        $param = [$name];
        $body = [
            'params' => $param,
            'method' => 'listtransactions',
        ];
        $curldata = $this->npmcurl($body);
        $details1 = $curldata;

        foreach ($details1 as $det) {
            if ($det['address'] == $tx_id) {
                if ($det['confirmations'] >= 0) {
                    return $det;
                }
            }
        }
        return  $details;
    }

    public function npmcurl($body)
    {

        try {
            $id = 0;
            $status       = null;
            $error        = null;
            $raw_response = null;
            $response     = null;

            // $proto=env('BTC_PROTO');
            // $username =env('BTC_USERNAME');
            // $password =env('BTC_PASSWORD');
            // $host =env('BTC_HOST');
            // $port =env('BTC_PORT');
            $proto = "http";
            $username = "LoSnLivR4SQqOaxsnByIxKyDcW5jpCn2Cls";
            $password = "TLRLNST1XdeVFQavNgoQQgW4baFxV5bsyPm";
            $host = "35.154.70.103";
            $port = "8555";
            $url = '';
            $CACertificate = null;
            $method = $body['method'];
            // If no parameters are passed, this will be an empty array
            $params = $body['params'];
            $params = array_values($params);
            // The ID should be unique for each call
            $id++;
            // Build the request, it's ok that params might have any empty array
            $request = json_encode(array(
                'method' => $method,
                'params' => $params,
                'id'     => $id
            ));
            //$curl    = curl_init("{$proto}://{$host}:{$port}/{$url}");
            $curl    = curl_init("{$proto}://{$host}:{$port}/");
            $options = array(
                CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
                CURLOPT_USERPWD        => $username . ':' . $password,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_HTTPHEADER     => array('Content-type: application/json'),
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $request
            );
            // This prevents users from getting the following warning when open_basedir is set:
            // Warning: curl_setopt() [function.curl-setopt]:
            //   CURLOPT_FOLLOWLOCATION cannot be activated when in safe_mode or an open_basedir is set
            if (ini_get('open_basedir')) {
                unset($options[CURLOPT_FOLLOWLOCATION]);
            }

            if ($proto == 'https') {
                // If the CA Certificate was specified we change CURL to look for it
                if (!empty($CACertificate)) {
                    $options[CURLOPT_CAINFO] = $CACertificate;
                    $options[CURLOPT_CAPATH] = DIRNAME($CACertificate);
                } else {
                    // If not we need to assume the SSL cannot be verified
                    // so we set this flag to FALSE to allow the connection
                    $options[CURLOPT_SSL_VERIFYPEER] = false;
                }
            }
            curl_setopt_array($curl, $options);
            // Execute the request and decode to an array
            $raw_response = curl_exec($curl);
            $response     = json_decode($raw_response, true);
            // If the status is not 200, something is wrong
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // If there was no error, this will be an empty string
            $curl_error = curl_error($curl);
            curl_close($curl);
            if (!empty($curl_error)) {
                $error = $curl_error;
            }
            if ($response['error']) {
                // If EINR returned an error, put that in $error
                $error = $response['error']['message'];
            } elseif ($status != 200) {
                // If EINR didn't return a nice error message, we need to make our own
                switch ($status) {
                    case 400:
                        $error = 'HTTP_BAD_REQUEST';
                        break;
                    case 401:
                        $error = 'HTTP_UNAUTHORIZED';
                        break;
                    case 403:
                        $error = 'HTTP_FORBIDDEN';
                        break;
                    case 404:
                        $error = 'HTTP_NOT_FOUND';
                        break;
                }
            }
            if ($error) {
                return false;
            }
            //dd($response);
            return $response['result'];
        } catch (Exception $e) {
        }
    }
}
