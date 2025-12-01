<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestTokenRequest extends Model
{
    protected $fillable = [
        'user_id',
        'wallet_address',
        'blockchain_id',
        'status',
        'tokens_sent',
        'transaction_hash',
        'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'tokens_sent' => 'decimal:8'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blockchain()
    {
        return $this->belongsTo(BlockchainModel::class, 'blockchain_id');
    }

    /**
     * Check if user has already received test tokens for this address
     */
    public static function hasReceivedTestTokens($userId, $walletAddress = null)
    {
        return self::where('user_id', $userId)
                   ->when($walletAddress, function ($query) use ($walletAddress) {
                    return $query->where('wallet_address', $walletAddress);
                   })
                   ->where('status', 'completed')
                   ->exists();
    }

    /**
     * Get pending test token requests
     */
    public static function getPendingRequests()
    {
        return self::where('status', 'pending')->get();
    }
}