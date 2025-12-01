<?php

namespace App;
use App\UserContract;

use Illuminate\Database\Eloquent\Model;

class IssuerTokenRequest extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }   

    public function propertydetails()
    {
        return $this->hasMany('App\PropertyDetails','token_request_id','id');
    }

    
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    public function usercontract(){
        return $this->hasOne(UserContract::class, 'property_id', 'property_id');
    }

    public function blockchain()
    {
        return $this->belongsTo(BlockchainModel::class, 'blockchain_id');
    }

}
