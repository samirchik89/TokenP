<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Stablecoin extends Model
{

   
   
    protected $fillable = ['title'];

    // Relationships
    public function blockchainStablecoins()
    {
        return $this->hasMany(BlockchainStablecoin::class);
    }


}



    // public function blockchains()
    // {
    //     return $this->belongsToMany(Blockchain::class, 'blockchain_stablecoins', 'stablecoin_id', 'blockchain_id')
    //         ->withPivot('address_testnet', 'address_mainnet')
    //         ->withTimestamps();
    // }