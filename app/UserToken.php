<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\WithdrawShare;
use App\WhiteListedWalletAddress;


class UserToken extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function usercontract()
    {
        return $this->belongsTo('App\UserContract','user_contract_id');
    }

    public function withdraw_share_amount(){
        return $this->hasMany(WithdrawShare::class, 'user_token_id', 'id');
    }

    public function getWithdrawnAmountSumAttribute() {
        return $this->withdraw_share_amount->sum('amount');
    }

    public function property(){
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function tokenTransaction()
    {
        return $this->hasOne(UserTokenTransaction::class, 'user_token_id', 'id');
    }

    public function whitelistedWalletAddress()
    {
        return $this->belongsTo(WhiteListedWalletAddress::class, 'wallet_id', 'id');
    }
    
    
    
    /**
	 * Used to Get UserContract Details
	 */
	public static function getUserToken($id = 0){
        $sql = UserToken::orderBy('created_at', 'desc');
        if($id !=0)
            $sql->where('user_contract_id', $id);
		
        return $sql;
	}

    protected $appends = ['withdrawn_amount_sum'];


    
  
}
