<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class AppFlowLog extends Model
{

    protected $table = 'app_flow_logs';

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'logtext',
        'meta',
        'process_id'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    // Relation to User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
