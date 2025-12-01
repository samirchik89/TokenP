<?php

namespace App;

use App\Models\PlaidItem;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USER_TYPE_ISSUER = 2;
    const USER_TYPE_INVESTOR = 1;

    const MAX_PROPERTY_TOKENS_DEMO = 3;
    const MAX_INVESTMENTS_DEMO = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type','dob','country_id','mobile','kyc','g2f_temp','eth_otp',
        'google2fa_secret','verified','email_token','issuer_pros_doc','issuer_kyc_doc','approved','btc_address','eth_address','account_type',
        'property_tokens_created', 'investments_made', 'ip_address', 'investor_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function addressbook()
    {
        return $this->hasMany('App\Addressbook', 'user_id');
    }

    /**
     * Used to get User Company Details
     */
    public function userCompany()
    {
        return $this->belongsTo('App\UserCompanyDetails', 'id', 'user_id');
    }

    public function identity()
    {
        return $this->hasOne('App\UserIdentity', 'user_id');
    }

    public function finance()
    {
        return $this->hasOne('App\UserFinance', 'user_id');
    }

    public function background()
    {
        return $this->hasOne('App\UserBackground', 'user_id');
    }

    public function isIssuer()
    {
        return $this->user_type === self::USER_TYPE_ISSUER;
    }

    public function isInvestor()
    {
        return $this->user_type === self::USER_TYPE_INVESTOR;
    }

    public static function getUser($id = 0)
    {
        $sql = User::orderBy('created_at', 'desc');
        if ($id != 0)
            $users = $sql->find($id);
        else
            $users = $sql->get();
        return $users;
    }

    public function plaidItems()
    {
        return $this->hasMany(PlaidItem::class);
    }

    public function country(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function investorShares(){
        return $this->hasOne('App\InvestorShares', 'user_id');
    }

    public function getRole(){
        return $this->user_type == self::USER_TYPE_ISSUER ? 'Issuer' : 'Investor';
    }

    /**
     * Check if issuer can create more property tokens (demo mode limit: 3)
     */
    public function canCreatePropertyToken()
    {
        return true;
        if (!$this->isIssuer()) {
            return false;
        }

        // In demo mode, limit to 3 property tokens
        if (config('app.is_demo')) {
            return $this->property_tokens_created < self::MAX_PROPERTY_TOKENS_DEMO;
        }

        // In production, no limit
        return true;
    }

    /**
     * Check if investor can make more investments (demo mode limit: 5)
     */
    public function canMakeInvestment()
    {
        return true;
        if (!$this->isInvestor()) {
            return false;
        }

        // In demo mode, limit to 5 investments
        if (config('app.is_demo')) {
            return $this->investments_made < self::MAX_INVESTMENTS_DEMO;
        }

        // In production, no limit
        return true;
    }

    /**
     * Increment property tokens created counter
     */
    public function incrementPropertyTokensCreated()
    {
        $this->increment('property_tokens_created');
    }

    /**
     * Increment investments made counter
     */
    public function incrementInvestmentsMade()
    {
        $this->increment('investments_made');
    }

    /**
     * Get remaining property tokens that can be created
     */
    public function getRemainingPropertyTokens()
    {
        if (!config('app.is_demo')) {
            return -1; // Unlimited
        }
        return max(0, self::MAX_PROPERTY_TOKENS_DEMO - $this->property_tokens_created);
    }

    /**
     * Get remaining investments that can be made
     */
    public function getRemainingInvestments()
    {
        if (!config('app.is_demo')) {
            return -1; // Unlimited
        }
        return max(0, 5 - $this->investments_made);
    }
}
