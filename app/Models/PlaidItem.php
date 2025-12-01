<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PlaidItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'item_id',
        'access_token',
        'institution_id',
        'status',
        'transactions_cursor',
        'accounts_data',
        'error_info'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'accounts_data' => 'array',
        'error_info' => 'array',
    ];

    /**
     * Get the user that owns the Plaid item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get active items only
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function accounts()
    {
        return $this->hasMany(PlaidItemAccount::class, 'plaid_item_id', 'id');
    }

    /**
     * Get transfers associated with this Plaid item.
     */
    public function transfers()
    {
        return $this->hasMany(PlaidTransfer::class, 'plaid_item_id', 'id');
    }

    /**
     * Get the institution associated with this Plaid item.
     */
    public function institution()
    {
        return $this->belongsTo(PlaidInstitution::class, 'plaid_institution_id');
    }
}