<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Property;
use App\User;

class Trade extends Model
{
    public function property(){
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function finish_user(){
        return $this->hasOne(User::class, 'id', 'finished_by');
    }
}
