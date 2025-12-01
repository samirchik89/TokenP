<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserContract;
use App\Property;
use App\UserTokenTransaction;

class AdminEarning extends Model
{
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user_contract(){
        return $this->hasOne(UserContract::class, 'id', 'contract_id');
    }

    public function user_toke_transaction(){
        return $this->hasOne(UserTokenTransaction::class, 'id', 'trx_id');
    }
}
