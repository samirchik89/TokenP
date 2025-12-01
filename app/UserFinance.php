<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFinance extends Model
{
 	protected $fillable=[
    	'user_id',
    	'type_of_ownership',
    	'us_resident',
    	'us_citizen',
    	'ssn_tax_id',
    	'custodial_account',
    	'accreditation',
    	'e_signature',
    	'preferred_distribution',
    	'routing_aba_number',
    	'swift_code',
    	'financial_insitution',
    	'financial_insitution_address',
    	'beneficiary_name',
    	'beneficiary_acc_number',
    	'beneficiary_acc_address',
    	'funding_note',
    	'further_credit',
    	'attn'
    ]; 
}
