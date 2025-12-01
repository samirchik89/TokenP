<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NodeController;
use Illuminate\Support\Facades\Log;
use App\UserToken;
use Setting;

class CommonController extends Controller
{
    /**
     * Used to Update Address and Destination Tag
     */
    public function updateAddress($user)
    {
        try {
            if (!$user->btc_address) {
                $name        = "adminaccount";
                $param       = [$name];
                $body        = ['params' => $param, 'method' => 'getnewaddress'];
                $btc_address = ((new NodeController)->npmcurl($body))->getData();

                $user->btc_address = ($btc_address->success == true) ? $btc_address->response : null;
                $user->save();
            }

            if (!$user->eth_address) {
                $eth_address       = ((new NodeController)->eth_address($user->email))->getData();
                $user->eth_address = ($eth_address->success == true) ? $eth_address->response : null;
                $user->save();
            }
            if (!$user->dest_tag) {
                $dest_tag       = mt_rand(100000000, 999999999);
                $user->dest_tag = $dest_tag;
                $user->save();
            }
            if (!$user->payment_address) {
                $payment_address       = ((new NodeController)->eth_address($user->email))->getData();
                $user->payment_address = ($payment_address->success == true) ? $payment_address->response : null;
                $user->save();
            }
        } catch (\Throwable $th) {
            Log::critical('updateAddress', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Used to Calculate Percentage and Investment Amount
     */
    public function calculatePercentage($property)
    {
        try {
            if (!empty($property)) {
                foreach ($property as $key => $value) {
                    if (!is_null($value->userContract)) {
                        $tokens                                = UserToken::where('user_contract_id', $value->userContract->id)->sum('token_acquire');
                        $usd_value                             = $value->userContract->tokenvalue * $tokens;
                        $property[$key]['accuired_usd']        = $usd_value;
                        $percentage                            = ($usd_value / $value->totalDealSize) * 100;
                        $property[$key]['accuired_percentage'] = $percentage;
                    } else {
                        $property[$key]['accuired_usd']        = 0;
                        $property[$key]['accuired_percentage'] = 0;
                    }
                }
            }
            return $property;
        } catch (\Throwable $th) {
            Log::critical('calculatePercentage', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Used to get Coin Price
     */
    public function getCryptoPrices()
    {
        $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=' . Setting::get('default_currency') . '&ids=bitcoin%2Cethereum%2Cripple&order=market_cap_desc&per_page=100&page=1&sparkline=false';

        $headers = [
            'Accepts: application/json',
        ];
        $request = "{$url}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $request,            // set the request URL
            CURLOPT_HTTPHEADER     => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response     = curl_exec($curl); // Send the request, save the response
        $cryptoprices = json_decode($response); // print json decoded response
        curl_close($curl); // Close request
        $coin_type        = [];
        $coin_type['BTC'] = 0;
        $coin_type['ETH'] = 0;
        $coin_type['XRP'] = 0;
        if (!empty($cryptoprices) && count($cryptoprices) > 0) {
            foreach ($cryptoprices as $price) {
                switch ($price->id) {
                    case 'bitcoin':
                        $coin_type['BTC'] = $price->current_price;
                        break;
                    case 'ethereum':
                        $coin_type['ETH'] = $price->current_price;
                        break;
                    case 'ripple':
                        $coin_type['XRP'] = $price->current_price;
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        return $coin_type;
    }
}
