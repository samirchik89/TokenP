<?php

use App\PromocodeUsage;

function currency($value = '')
{
	if ($value == "") {
		return Setting::get('currency') . "0.00";
	} else {
		return Setting::get('currency') . $value;
	}
}

function balance($value = '')
{
	if ($value == "") {
		return "0.00";
	} else {
		return $value;
	}
}


function wrap_string($string, $start = 0, $total = 8)
{
	return substr($string, $start, $total) . '****' . substr($string, -6);
}

if (!function_exists('price_format')) {
	function price_format($price, $decimal = null)
	{
		$value = (float)$price;
		if (strlen(substr(strrchr($value, "."), 1)) < 1) {
			return number_format($value, 2, '.', '');
		} else if ($decimal) {
			return number_format($value, $decimal, '.', '');
		} else {
			return $value;
		}
	}
}

function img($img)
{
	if ($img == "") {
		return asset('main/avatar.jpg');
	} else if (strpos($img, 'http') !== false) {
		return $img;
	} else {
		return asset('storage/' . $img);
	}
}

function logo()
{
	$logo = \Setting::get('site_logo');
	if ($logo == "") {
		return asset('main/avatar.jpg');
	} else if (strpos($logo, 'http') !== false) {
		return $logo;
	} else {
		return asset('logo.png');
	}
}

function favicon()
{
	$logo = \Setting::get('site_icon');
	if ($logo == "") {
		return asset('main/avatar.jpg');
	} else if (strpos($logo, 'http') !== false) {
		return $logo;
	} else {
		return asset('storage/' . $logo);
	}
}


function image($img)
{
	if ($img == "") {
		return asset('main/avatar.jpg');
	} else {
		return asset($img);
	}
}

function ico()
{
	return Setting::get('coin_symbol');
}

function promo_used_count($promo_id)
{
	return PromocodeUsage::where('status', 'USED')->where('promocode_id', $promo_id)->count();
}

function countries()
{
	return \App\Country::get();
}

function cities($country_code = 'AF')
{
	return \App\City::wherecountry_code($country_code)->get();
}


function digitround($number, $decimals = 8)
{

	$factor = pow(10, $decimals);
	$res = intval($number * $factor) / $factor;
	return $res;
}

function getCountyCode()
{
	return \App\CountryCode::get()->toArray();
}
