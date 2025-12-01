<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    protected $fillable = [
        'coin_name','coin_type','symbol', 'sort_order', 'image','contract_address','address'
    ];

    public function addressbook()
    {
        return $this->hasManyThrough('App\AddressBook','App\Coins','coin_symbol','symbol');
    }

    public function getCoin($payby){
        $coin = Coins::where('symbol', $payby)->first();
        return $coin;
    }
}
