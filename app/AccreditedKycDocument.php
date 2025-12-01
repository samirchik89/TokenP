<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccreditedKycDocument extends Model
{   
    // use SoftDeletes;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'accredited_document_id',
        'url',
        'unique_id',
        'status',
        'back_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The services that belong to the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * The services that belong to the user.
     */
    public function accrediteddocument()
    {
        return $this->belongsTo('App\AccreditedDocument','accredited_document_id');
    }

    public function document(){
        return $this->belongsTo('App\Document','accredited_document_id');
    }

    
}
