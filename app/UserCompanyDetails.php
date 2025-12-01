<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompanyDetails extends Model
{
    public function fund()
    {
        return $this->belongsTo('App\FundTypes','fund_type','id');
    }
}
