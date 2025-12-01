<?php

namespace App;
use App\User;
use App\Bank;

use Illuminate\Database\Eloquent\Model;

class DepositFiat extends Model
{
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function bank(){
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }
}
