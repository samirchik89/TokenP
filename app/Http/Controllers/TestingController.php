<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvestorShares;
use App\WhiteListedWalletAddress;


class TestingController extends Controller
{
    
    // get token address and chain info from DB of this token
    // loop through this investor, tokenid get all of his whitelisted addresses and loop through
    // call node server get balance passing chain, contract address and whitelisted address and get current balance from blockchain and update DB.

    // Calculate this investor’s total external wallet address balances
    // update investor-shares table external wallet total and also external wallet + internal wallet balances
    public function test(Request $request){
       $data = $this->updateInvestorTokenExternalWalletBalances(228,4);
       return response()->json($data);
    }

    public function updateInvestorTokenExternalWalletBalances ($investorId,$tokenId){
        $investorShares = InvestorShares::with('userContract')->where('user_id',$investorId)->where('user_contract_id',$tokenId)->first();
        $contractDetails = $investorShares->usercontract;

        $wallets = WhiteListedWalletAddress::where('user_id',$investorId)
            ->where('contract_id',$tokenId)
            ->whereRaw("wallet_address IS NOT NULL AND wallet_address != ''")
            ->get();
        $blockchain = $contractDetails->blockchain;
        $totalBalance = 0;
        foreach($wallets as $wallet){
            $payload = [
                "chain" => $blockchain->abbreviation,
                "contract_address" => $contractDetails->contract_address,
                "address" => $wallet->wallet_address
            ];
            $response = callNodeOperations('getTokenBalance',$payload);
            if(!empty($response['status']) && $response['status'] == 'success'){
                $wallet->balance = $response['balance'];
                $totalBalance += $response['balance'];
                $wallet->save();
            }
        }
        $investorShares->external_wallet = $totalBalance;
        $investorShares->save();


        return $wallets;

    }  

}
