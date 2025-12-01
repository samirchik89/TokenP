<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIdentity extends Model
{
	protected $fillable = [
		'user_id',
		'first_name',
		'last_name',
		'dob',
		'citizenship',
		'residence',
		'ssn_tax_id',
		'document',
		'photo',
		'primary_phone',
		'primary_country_code',
		'secondary_phone',
		'secondary_country_code',
		'address_line_1',
		'address_line_2',
		'country_code',
		'city_id',
		'province',
		'postal_code'
	];


	public function country()
	{
		return $this->hasOne('App\Country', 'code', 'country_code');
	}

	public function city()
	{
		return $this->hasOne('App\City', 'country_code', 'country_code');
	}

	public function getPhoneAttribute()
	{
		return \explode('-', $this->primary_phone)[1];
	}

	public function getCountryCodeAttribute($value)
	{
		return \explode('-', $this->primary_phone)[0];
	}
}
