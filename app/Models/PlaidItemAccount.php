<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaidItemAccount extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'plaid_item_id',
        'account_id',
        'persistent_account_id',
        'name',
        'official_name',
        'type',
        'subtype',
        'mask',
        'status',
        'balances',
        'extra_data',
    ];

    protected $casts = [
        'balances' => 'array',
        'extra_data' => 'array',
    ];

    /**
     * Get the plaid item that owns the account.
     */
    public function plaidItem(): BelongsTo
    {
        return $this->belongsTo(PlaidItem::class, 'plaid_item_id', 'id');
    }

    /**
     * Get transfers associated with this account.
     */
    public function transfers()
    {
        return $this->hasMany(PlaidTransfer::class, 'plaid_item_account_id', 'id');
    }
}