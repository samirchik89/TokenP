<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyComparable extends Model
{
    protected $fillable = [
        'property_id',
        'property',
        'type',
        'location',
        'distance',
        'rent',
        'saleprice'
    ];
}
