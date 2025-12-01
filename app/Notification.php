<?php
namespace App;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Notification extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'notification_type', 'is_viewed'
    ];

    protected $appends = ['alert_class']; // Optional: include in JSON/array output

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAlertClassAttribute()
    {
        switch ($this->notification_type) {
            case 'success':
                return ['class' => 'alert alert-success', 'color' => '#28a745'];
            case 'warning':
                return ['class' => 'alert alert-warning', 'color' => '#ffc107'];
            case 'error':
            case 'danger':
                return ['class' => 'alert alert-danger', 'color' => '#dc3545'];
            case 'info':
                return ['class' => 'alert alert-info', 'color' => '#17a2b8'];
            default:
                return ['class' => 'alert alert-secondary', 'color' => '#6c757d'];
        }
    }
}



