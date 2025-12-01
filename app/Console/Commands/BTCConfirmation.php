<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DepositHistory;
use Illuminate\Support\Facades\DB;

class BTCConfirmation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'btc:checkstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'BTC Confirmation status';

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
        \Log::info("Cron Runs:");

        $history = DepositHistory::where('status', 'pending')->where('type', 'BTC')->get();

        foreach ($history as $historys) {
            $request = new \Illuminate\Http\Request();
            $request->replace(['tx_id' => $historys->address]);
            \Log::info($request->tx_id);
            $result = $this->history($request);

            if ($result['confirmations'] >= 3) {
                $historys->status = 'success';
                $historys->save();
                \Log::info("Cron Runs:" . $historys->id);
            }
        }

        DB::connection()->disconnect();
    }

    public function history(Request $request)
    {
        //$tx = TransactionHistory::where('payment_id', $request->tx_id)->first();
        // if($tx) {
        //     return 1;
        // } else {
        //     return 0;
        // }
        $name = "adminaccount";
        $param = [$request->tx_id];
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

            if ($det['address'] == $request->tx_id) {

                if ($det['confirmations'] >= 0) {
                    return $det;
                }
            }
        }
        //dd($details1);

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
