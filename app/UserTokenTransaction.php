<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\AdminEarning;

class UserTokenTransaction extends Model
{

    const STATUS_SUCCESS = 1;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function usertoken()
    {
        return $this->belongsTo('App\UserToken','user_token_id');
    }

    public function usercontract()
    {
        return $this->belongsTo('App\UserContract','user_contract_id');
    }


    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 0:
                $text = 'Failed';
                $class = 'text-danger';
                break;
            case 1:
                $text = 'Success';
                $class = 'text-success';
                break;
            case 2:
                $text = 'Success';
                $class = 'text-success';
                break;

                case 3:
                $text = 'Pending';
                $class = 'text-warning';
                break;

            default:
                # code...
                break;
        }
        return ['text' => $text ?? 'Failed', 'class' => $class ?? 'text-danger'] ;
    }
    public static function getGroupingByMonths_UT($user_id){
        return  UserTokenTransaction::with('usercontract.property')->where('user_id',$user_id)->where('status',1)
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
    }
    public static function getGroupingByMonthsAdmin(){
        return  UserTokenTransaction::with('usercontract.property')->select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
    }

    public function admin_earning(){
        return $this->hasOne(AdminEarning::class, 'trx_id', 'id');
    }
}
