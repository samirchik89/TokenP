<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NodeController extends Controller
{
    /**
     * Used to Connect Bitcoin Node
     */
    public function npmcurl($body)
    {

        try {
            $id = 0;
            $raw_response = null;
            $response     = null;

            $proto = env('BTC_PROTO');
            $username = env('BTC_USERNAME');
            $password = env('BTC_PASSWORD');
            $host = env('BTC_HOST');
            $port = env('BTC_PORT');

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
            if ($response['error'])
                return response()->json(['success' => FALSE, 'message' => $response['error']['message']]);
            else
                return response()->json(['success' => TRUE, 'response' => $response['result']]);
        } catch (\Exception $e) {
            return response()->json(['success' => FALSE, 'message' => 'Unable to connect BTC node']);
        }
    }

    /**
     * Used to Connect ETH node
     */
    public function eth_address($email)
    {
        try {
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/json',
            ];
            $body = ["string" => $email];
            $url = env('BASE_NODE_URL').'/CreateAccount';

            $res = $client->post($url, [
                'headers' => $headers,
                'body' => json_encode($body),
            ]);
            $eth_address = json_decode($res->getBody(), true);
            $eth_address = (isset($eth_address['account'])) ? $eth_address['account'] : NULL;
            return response()->json(['success' => TRUE, 'response' => $eth_address]);
        } catch (\Throwable $th) {
            return response()->json(['success' => FALSE, 'message' => 'Unable to communicate MATIC node']);
        }
    }

    /**
     * Used to Get BTC Balance
     */
    public function getBalance($email)
    {
        try {
            $balance_param = [$email, 1];
            $balance_body = [
                'params' => $balance_param,
                'method' => 'getbalance',
            ];
            $balance_curldata = $this->npmcurl($balance_body);

            return response()->json(['success' => TRUE, 'response' => $balance_curldata['result']]);
        } catch (\Throwable $th) {
            return response()->json(['success' => FALSE, 'message' => 'Unable to update Balance']);
        }
    }

    public function getETHBalance($value, $address){
        $client=new Client;
        $headers=[
            'content-type'=>'application/json'
        ];
        $body=[
            'chain'=>$value,
            'address'=>$address
        ];
        $url='http://localhost:3000/native_balance';
        $res=$client->post($url,[
            'headers'=>$headers,
            'body'=>json_encode($body)
        ]);
        $response=json_decode($res->getBody(),true);
        return $response['status']=='success' ? $response['balance'] : 0;
    }
    public function getTokenBalance($address,$contract){
        $client=new Client;
        $headers=[
            'content-type'=>'application/json'
        ];
        $body=[
            'chain'=>'MATIC',
            'address'=>$address,
            'contract_address'=>$contract
        ];
        $url='http://localhost:3000/balance';
        $res=$client->post($url,[
            'headers'=>$headers,
            'body'=>json_encode($body)
        ]);
        $response=json_decode($res->getBody(),true);
        return $response['status']=='success' ? $response['balance'] : 0;
    }
}
