<?php

namespace App\Http\Controllers;

use ValidatesRequests;
use Auth;
use Cache;
use Crypt;
use Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use \ParagonIE\ConstantTime\Base32;
use App\Http\Requests\ValidateSecretRequest;
use App\User;

class Google2FAController extends Controller
{


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function enableTwoFactor(Request $request)
    {
        //get user
        $user = $request->user();
        if (is_null($user->g2f_temp)) {
            //generate new secret
            $secret = $this->generateSecret();
            //encrypt and then save secret              
            $user->g2f_temp = Crypt::encryptString($secret);
            $user->save();

            //generate image for QR barcode
            $imageDataUri = Google2FA::getQRCodeInline(
                $request->getHttpHost(),
                $user->email,
                $secret,
                200
            );
        } else {
            $secret = Crypt::decryptString($user->g2f_temp);
            $imageDataUri = Google2FA::getQRCodeInline(
                $request->getHttpHost(),
                $user->email,
                $secret,
                200
            );
        }
        if ($request->ajax())
            return ['image' => $imageDataUri, 'secret' => $secret];
        else
            return view('/2fa/enable2fa', ['image' => $imageDataUri, 'secret' => $secret]);
        //return view('/2fa/enableTwoFactor', ['image' => $imageDataUri,'secret' => $secret]);            

    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disableTwoFactor(Request $request)
    {
        $user = auth()->user();
        $secret = Crypt::decrypt($user->google2fa_secret);
        $verifyOtp = Google2FA::verifyKey($secret, $request->otp);

        if (!$verifyOtp) {
            \Session::flash('flash_error', "Invalid OTP !!");
            return redirect()->back();
        }
        $user->google2fa_secret = null;
        $user->g2f_status = 0;
        $user->save();
        //return view('2fa/disableTwoFactor');
        \Session::flash('flash_warning', "Google two factor authentication disabled...");
        // if(Auth::user()->user_type==2){
        return redirect()->back();
        //}

        return redirect('/setting');
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     */
    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }

    public function g2fotpcheckenable(Request $request)
    {
        $user = Auth::user();
        $key    = $user->id . ':' . $request->totp;
        $secret = Crypt::decryptString($user->g2f_temp);
        \Log::info($secret);
        $temp = Google2FA::verifyKey($secret, $request->totp);
        \Log::info($temp);

        $response = [];
        $status = 0;
        $message = "";

        if (!Cache::has($key)) {
            if ($temp == true) {
                Cache::add($key, true, 4);

                $user = User::findOrFail($user->id);
                $user->google2fa_secret = $user->g2f_temp;
                $user->g2f_temp = null;
                $user->save();

                $status = 1;
                $message = "Google two factor authentication enabled successfully...";

                //\Session::flash('flash_success',"Google two factor authentication enabled successfully...");

            } else {
                $status = 0;
                $message = "Please check the otp, and try again...";
                //\Session::flash('flash_error',"Please check the otp, and try again...");
            }
        } else {

            $status = 0;
            $message = "Used token,Cannot reuse token...";
            //\Session::flash('flash_error',"Used Token,Cannot reuse token...");            
        }
        //return redirect('/security');
        //$response=['status'=>$status,'message'=>$message];

        return response()->json(['status' => $status, 'message' => $message], 200);
    }

    public function g2fotpcheckenablenew(Request $request)
    {
        try {
            $user = Auth::user();
            $key    = $user->id . ':' . $request->totp;
            $secret = Crypt::decrypt(Auth::user()->g2f_temp);
            $verifyOtp = Google2FA::verifyKey($secret, $request->totp);

            if (!Cache::has($key)) {
                if ($verifyOtp == true) {
                    Cache::add($key, true, 4);

                    $user = Auth::user();
                    $user->g2f_status = '1';
                    $user->google2fa_secret = $user->g2f_temp;
                    // $user->g2f_temp = Null;
                    $user->save();

                    $status = 1;
                    $message = 'Google two factor authentication enabled successfully...';
                } else {
                    $status = 0;
                    $message = 'Please check the otp, and try again...';
                }
            } else {

                $status = 0;
                $message = 'Used token,Cannot reuse token...';
            }

            return response()->json(['status' => $status, 'message' => $message], 200);
        } catch (Exception $e) {
        }
    }

    public function enableTwoFactorapi(Request $request)
    {
        try {
            //generate new secret
            $secret = $this->generateSecret();

            //get user
            $user = $request->user();

            //encrypt and then save secret            
            $user->g2f_temp = Crypt::encryptString($secret);
            $user->save();

            return response()->json(['secret' => $secret], 200);
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }

    public function disableTwoFactorapi(Request $request)
    {
        try {
            $user = $request->user();
            //make secret column blank
            $user->google2fa_secret = null;
            //$user->g2f_temp = null;
            $user->save();

            return response()->json(['message' => 'Disabled Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }

    public function gfavalidateotp(Request $request)
    {
        $user = Auth::user();

        $key    = $user->id . ':' . $request->totp;
        $secret = Crypt::decryptString($user->g2f_temp);
        $temp = Google2FA::verifyKey($secret, $request->totp);

        if (!Cache::has($key)) {
            if ($temp == true) {
                Cache::add($key, true, 4);
                return response()->json(['status' => 1, 'message' => 'Logged Successfully'], 200);
            } else {
                return response()->json(['status' => 0, 'message' => 'Token Mismatch'], 200);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Used Token,Cannot reuse token'], 200);
        }
    }
}
