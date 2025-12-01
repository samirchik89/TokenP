<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryCode extends Model
{
    protected $fillable = ['name', 'dial_code', 'code'];
}
