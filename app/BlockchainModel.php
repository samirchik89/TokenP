<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class BlockchainModel extends Model
{
    protected $table = 'blockchains';

    protected $guarded = [];



    public function stablecoins()
    {
        return $this->belongsToMany(Stablecoin::class, 'blockchain_id', 'stablecoin_id');
    }

    public function properties(){
        return $this->hasMany(Property::class);
    }

    public function userContracts(){
        return $this->hasMany(UserContract::class);
    }
}
