<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class WithdrawEth extends Model
{
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
