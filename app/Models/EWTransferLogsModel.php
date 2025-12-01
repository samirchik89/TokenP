<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\WhiteListedWalletAddress;
class EWTransferLogsModel extends Model
{

    protected $table = 'external_wallet_transfer_logs';
    protected $fillable = [
        'user_id',
        'wallet_id',
        'user_contract_id',
        'token_count',
        'status',
        'note',
        'transaction_hash',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(WhiteListedWalletAddress::class);
    }

    public function userContract()
    {
        return $this->belongsTo(UserContract::class);
    }
}
