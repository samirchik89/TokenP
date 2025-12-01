<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
 

   protected $fillable = [
       'code', 'name',
   ];

   public function countryuser(){
   	 return $this->belongsTo('App\User','country','code');
   }
   public function city(){
   	 return $this->belongsTo('App\City','code','country_code');
   }

}
