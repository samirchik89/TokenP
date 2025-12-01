<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class IssuerBankAccounts extends Model
{
    protected $table = 'issuer_bank_accounts';
    protected $fillable = [
        'issuer_id',
        'bank_name',
        'bank_location',
        'bank_address',
        'bank_account_name',
        'routing_details',
        'beneficiary_name',
        'user_contract_id',
    ];

    // Many bank details belong to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
