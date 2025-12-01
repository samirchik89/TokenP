<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserContract extends Model
{ 


	protected $table = 'usercontract';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
  		//'user_id',
    	'tokenname',
    	'tokensymbol',
    	'tokenvalue',
    	'tokensupply',
    	'contract_address',
        'bonus',
    	'acquistion',
    	'usage',
    	'redemption',
    	'decimal',
        'token_image',            
        'title',            
        'content',            
    	'banner_image',
        'status', 'tokenbalance',  
        'blockchain_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];//

    /**
     * Used to Get Property Details
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id'); // adjust if the FK is named differently
    }

    public function blockchain(){
        return $this->belongsTo(BlockchainModel::class,'blockchain_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getGroupingByMonths($user_id){
        return  UserContract::where('user_id',$user_id)->where('status',1)->select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
    }
    
    public static function getGroupingByMonthsAdmin(){
        return  UserContract::where('status',1)->select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
    }

    public function investorShares(){
        return $this->hasMany(InvestorShare::class, 'user_contract_id');
    }



}
