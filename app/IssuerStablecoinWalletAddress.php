<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Blockchain;
use App\Stablecoin;

class IssuerStablecoinWalletAddress extends Model
{

    protected $guarded = [];


    public function issuer()
    {
        return $this->belongsTo(User::class, 'issuer_id');
    }


    public function blockchainStablecoin()
    {
        return $this->belongsTo(BlockchainStablecoin::class, 'blockchain_stablecoin_id');
    }
}
