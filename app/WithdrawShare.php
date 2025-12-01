<?php

namespace App;
use App\UserContract;
use App\UserToken;
use App\User;

use Illuminate\Database\Eloquent\Model;

class WithdrawShare extends Model
{
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user_token(){
        return $this->hasOne(UserToken::class, 'id', 'user_token_id');
    }
}
