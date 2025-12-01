<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaidItemAccountNumber extends Model
{
    protected $table = 'plaid_item_account_numbers';

    protected $fillable = [
        'plaid_item_account_id',
        'network_key',
        'account',
        'routing',
        'wire_routing',
    ];

    protected $casts = [
        'plaid_item_account_id' => 'integer',
    ];

    /**
     * Get the plaid item account that owns this account number.
     */
    public function plaidItemAccount()
    {
        return $this->belongsTo(PlaidItemAccount::class);
    }
}