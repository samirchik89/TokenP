<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlaidInstitution extends Model
{
    protected $fillable = [
        'institution_id',
        'name',
        'logo',
        'primary_color',
        'products',
        'country_codes',
        'oauth',
        'status',
        'routing_numbers',
    ];

    protected $casts = [
        'products' => 'array',
        'country_codes' => 'array',
        'oauth' => 'array',
        'status' => 'array',
        'routing_numbers' => 'array',
    ];

    /**
     * Get the Plaid items associated with this institution.
     */
    public function plaidItems(): HasMany
    {
        return $this->hasMany(PlaidItem::class);
    }

    /**
     * Store or update institution data from Plaid API response
     */
    public static function storeFromPlaidResponse(array $institutionData): self
    {
        return static::updateOrCreate(
            ['institution_id' => $institutionData['institution_id']],
            [
                'name' => $institutionData['name'],
                'logo' => $institutionData['logo'] ?? null,
                'primary_color' => $institutionData['primary_color'] ?? null,
                'products' => $institutionData['products'] ?? null,
                'country_codes' => $institutionData['country_codes'] ?? null,
                'oauth' => $institutionData['oauth'] ?? null,
                'status' => $institutionData['status'] ?? null,
                'routing_numbers' => $institutionData['routing_numbers'] ?? null,
            ]
        );
    }
}