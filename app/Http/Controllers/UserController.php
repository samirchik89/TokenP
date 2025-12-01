<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ValidatesRequests;
use Auth;
use Cache;
use Crypt;
use Google2FA;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;
use \ParagonIE\ConstantTime\Base32;
use App\Http\Requests\ValidateSecretRequest;

use App\User;

class UserController extends Controller
{
    public function g2fenablesuccess($id)
    {
        if ($id == 1) {
            \Session::flash('flash_success', "Google two factor authentication enabled successfully...");
        }
        return redirect('/security');
    }

    public function security(Request $request)
    {
        $user = Auth::user();

        //generate new secret
        $secret = $this->generateSecret();

        //get user
        //$user = $request->user();

        //encrypt and then save secret
        //$user->google2fa_secret = Crypt::encrypt($secret);
        $user->g2f_temp = Crypt::encrypt($secret);
        $user->save();

        //$google2fa=Google2FA::setAllowInsecureCallToGoogleApis(true);
        $image = Google2FA::getQRCodeInline(
            $request->getHttpHost(),
            $user->email,
            $secret,
            200
        );
        //generate image for QR barcode        
        // $image = $google2fa->getQRCodeGoogleUrl(
        //     $request->getHttpHost(),
        //     $user->email,
        //     $secret,
        //     200
        // );

        return view('security', compact('user', 'image', 'secret'));
    }

    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }

    public function wyretest()
    {
        $client = new Client;
        $url = "https://api.testwyre.com/v2/paymentMethods";
        //$client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
        ];
        $body = ["publicToken" => "public-sandbox-864f74a1-2fa0-4939-a102-7a41a453cfad|AJxlJ4Ra41HKo8zmbBBvu4vVZjDqbrF1wv9na", "paymentMethodType" => "LOCAL_TRANSFER", "country" => "US"];

        $res = $client->post($url, [
            'headers' => $headers,
            'body' => json_encode($body),
        ]);
        return $details = json_decode($res->getBody(), true);
    }

    public function countrycity($country)
    {
        try {
            return \App\City::wherecountry_code($country)->get();
        } catch (\Exception $e) {
            return false;
        }
    }
}
