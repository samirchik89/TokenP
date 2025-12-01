<?php

namespace App;
use App\User;
use App\Property;
use App\UserContract;

use Illuminate\Database\Eloquent\Model;

class InvestorWhitelist extends Model
{
    protected $guarded = [];

    const STATUS_IN_PROGRESS = 'In Progress';
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function property(){
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function usercontract(){
        return $this->hasOne(UserContract::class, 'property_id', 'property_id');
    }

    public function identity(){

        return $this->hasOne(UserIdentity::class, 'user_id', 'user_id');
    }

}
