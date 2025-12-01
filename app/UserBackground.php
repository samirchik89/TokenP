<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBackground extends Model
{
    protected $fillable=[
    	'user_id',
    	'investment_experience',
    	'investment_size',
    	'investment_type',
    	'investment_objective',
    	'previously_invested',
    	'property_type',
    	'geography',
    	'holding_period',
    	'expected_investment_nxt_1year',
    	'expected_investment_per_project',
    	'risk_type'
    ]; 
}
