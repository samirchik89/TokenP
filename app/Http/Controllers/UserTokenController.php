<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\UserContract;
use App\TokenType;
use App\Coins;
use App\UserToken;
use App\UserTokenTransaction;
use App\AddressBook;
use App\WithdrawShare;


class UserTokenController extends Controller
{
    public function index(){
        try {
            $user_token=UserToken::getUserToken()->latest()->get();
            return view('admin.usertoken.index',compact('user_token'));
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Unable to Get User Token Details');
        }        
    }

    public function GetWhitelistDetails($id, $user){
        try {
            $get_whitelist = WithdrawShare::where('user_token_id', $id)->where('user_id', $user)->orderBy('id', 'desc')->get();
            
            foreach ($get_whitelist as $key => $value) {
                $usercontract = UserToken::where('user_contract_id', $value->user_token_id)->first();
                $value->user_contract = $usercontract->id;
            }
            
            return view('admin.usertoken.whitelist', compact('get_whitelist'));
        } catch (\Throwable $th) {
            \Log::info($th);
            return back()->with('flash_error', 'Unable to get the data');
        }
    }

    public function tokenusertransaction($id){
        $user_token_txn=UserTokenTransaction::where('user_token_id',$id)->latest()->get();
        $page=1;
        return view('admin.usertoken.usertransaction',compact('user_token','page'));
    }    

    public function tokentransaction(){
        $user_token_txn=UserTokenTransaction::orderBy('status','desc')->latest()->get();
        $page=0;
        return view('admin.usertoken.usertransaction',compact('user_token_txn','page'));
    }

    public function tokentransactionstatus($id){

		$user_token_txn=UserTokenTransaction::findorFail($id);
		
		$contract_id=$user_token_txn->user_contract_id;

		$user_contract=UserContract::findorFail($contract_id);

		$user_id=$user_token_txn->user_id;

		$address_book=AddressBook::where('user_id',$user_id)->where('coin_symbol','MATIC')->first();

		$coins=Coins::where('symbol','MATIC')->first();


    	$address=$coins->address;
        $to_address=$address_book->address;
        $total_token=$user_token_txn->total_token;
        $contractABI=Setting::get('contract_abi');                
        $contract = $user_contract->contract_address;

    	$eth_pvt_key_temp=$coins['star_reference_counter'].$coins['port_reference_counter'];
    	$eth_pvt_key=$this->simple_crypt($eth_pvt_key_temp,'decrypt');

    	$url ="http://localhost:8082/senderc";
        
        $client = new Client();
        
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $quorum_url="http://3.17.77.216:22000";

        $body = ["quorum_url"=>$quorum_url,"token_tag" => $eth_pvt_key,"from" => $address,"to" => $to_address,"total_token" => $total_token,"contract" => $contract,"contractABI" => $contractABI,"decimal"=>$user_contract->decimal];

        $res = $client->post($url, [
            'headers' => $headers,
            'body' => json_encode($body),
        ]);
        $details = json_decode($res->getBody(),true);

        //return $details;

        //\Log::info($details);                    
        
        if($details['result']==1){ 

            if($details['status']==1){ 

		        $user_token_txn->status=1;
		        $user_token_txn->save();

		        $user_token=UserToken::findorFail($user_token_txn->user_token_id);
		        $total=$user_token->token_acquire+$total_token;
		        $user_token->token_acquire=$total;
		        $user_token->save();

		        return back()->with('flash_success','Transaction updated successfully');
	    	}

    	}elseif($details['result']==0){ 
            return response()->json(['error' => $details['error']], 500); 
        }
        else{
            return response()->json(['error' => $details['msg']], 500); 
        }

    }


    public function dividend(){
    	$user_token_txn=UserTokenTransaction::where('status',1)->latest()->get();
        
        return view('admin.usertoken.dividend',compact('user_token_txn'));
    }

    public function simple_crypt($string, $action = 'encrypt'){
        
        $key = "YMoEtIgr#W&Ab7uu3mlZeanIMr";   

        $res = '';
        if($action !== 'encrypt'){
            $string = base64_decode($string);
        }
        for( $i = 0; $i < strlen($string); $i++){
            $c = ord(substr($string, $i));
            if($action == 'encrypt'){
                $c += ord(substr($key, (($i + 1) % strlen($key))));
                $res .= chr($c & 0xFF);
            }else{
                $c -= ord(substr($key, (($i + 1) % strlen($key))));
                $res .= chr(abs($c) & 0xFF);
            }
        }
        if($action == 'encrypt'){
            $res = base64_encode($res);
        }
        return $res;
    }

}
