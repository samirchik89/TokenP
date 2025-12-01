<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserToken;

class InvestmentController extends Controller
{
    /**
     * Store crypto transfer
     */
    public function checkBeforePay(Request $request)
    {
        $userToken = UserToken::where('id', $request->user_token_id)->first();

        if($userToken->current_stage < 2){
            return response()->json([
                'status' => 'error',
                'message' => 'Set the custody of the tokens for payment proceeding'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tokens are ready for payment'
        ]);
    }

}