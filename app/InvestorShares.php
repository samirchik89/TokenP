<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestorShares extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function userContract(){
        return $this->belongsTo(UserContract::class, 'user_contract_id');
    }


}
