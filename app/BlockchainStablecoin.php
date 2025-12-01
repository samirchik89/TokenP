<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class BlockchainStablecoin extends Model
{

   
    protected $guarded = [];
    public function blockchain()
    {
        return $this->belongsTo(BlockchainModel::class, 'blockchain_id');
    }

    public function stablecoin()
    {
        return $this->belongsTo(Stablecoin::class);
    }

  

}

