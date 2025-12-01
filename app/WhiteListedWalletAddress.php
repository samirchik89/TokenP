<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhiteListedWalletAddress extends Model
{
    protected $guarded = [];
    protected $table = 'whitelisted_wallet_addresses';
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
