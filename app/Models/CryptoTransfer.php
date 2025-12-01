<?php

namespace App\Models;

use App\BlockchainStablecoin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\User;
use App\IssuerStablecoinWalletAddress;
use App\Services\TokenPaymentService;
use App\UserToken;

class CryptoTransfer extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'sender_address',
        'recipient_address',
        'amount',
        'blockchain_stablecoin_id',
        'status',
        'transaction_hash',
        'metadata',
        'user_token_id',
    ];

    protected $casts = [
        'amount' => 'decimal:8', // High precision for crypto amounts
        'metadata' => 'array',
    ];

    /**
     * Get the user that owns the transfer
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the blockchain stablecoin relationship
     */
    public function issuerWallet(): BelongsTo
    {
        return $this->belongsTo(IssuerStablecoinWalletAddress::class, 'blockchain_stablecoin_id');
    }

    /**
     * Check if transfer is in a final state
     */
    public function isFinal()
    {
        return in_array($this->status, [self::STATUS_COMPLETED, self::STATUS_FAILED, self::STATUS_CANCELLED]);
    }

    /**
     * Check if transfer was successful
     */
    public function isSuccessful()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if transfer failed
     */
    public function hasFailed()
    {
        return in_array($this->status, [self::STATUS_FAILED, self::STATUS_CANCELLED]);
    }

    /**
     * Check if transfer is pending
     */
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Scope for pending transfers
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for completed transfers
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope for failed transfers
     */
    public function scopeFailed($query)
    {
        return $query->whereIn('status', [self::STATUS_FAILED, self::STATUS_CANCELLED]);
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 8) . ' tokens';
    }

    /**
     * Get explorer URL for the transaction
     */
    public function getExplorerUrlAttribute()
    {
        // Get chain_id from the blockchain stablecoin relationship
        $chainId = $this->blockchainStablecoin->blockchain->chain_id ?? 1;

        $explorerUrls = [
            1 => 'https://etherscan.io', // Ethereum Mainnet
            11155111 => 'https://sepolia.etherscan.io', // Sepolia Testnet
            137 => 'https://polygonscan.com', // Polygon Mainnet
            80001 => 'https://mumbai.polygonscan.com', // Mumbai Testnet
            56 => 'https://bscscan.com', // BSC Mainnet
            97 => 'https://testnet.bscscan.com', // BSC Testnet
        ];

        $explorerUrl = $explorerUrls[$chainId] ?? 'https://etherscan.io';
        return $explorerUrl . '/tx/' . $this->transaction_hash;
    }

    public function setStatus($status)
    {
        if($status == self::STATUS_COMPLETED && $this->status == self::STATUS_PENDING){
            $tokenService = new TokenPaymentService();
            $userToken = UserToken::where('id', $this->user_token_id)->first();
            $tokenService->transferTokens($userToken);
        }
        $this->status = $status;
    }
}