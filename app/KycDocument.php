<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KycDocument extends Model
{   
    protected $table = 'kyc_documents';

    use SoftDeletes;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'document_id',
        'url',
        'unique_id',
        'status',
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
    public function document()
    {
        return $this->belongsTo('App\Document','document_id');
    }

    public function corpdocument()
    {
        return $this->belongsTo('App\CorpDocument','document_id');
    }

    /**
     * Used to Get Kyc Documents
     */
    public static function getDocuments($id, $status = ''){ 
        $sql = KycDocument::orderBy('created_at', 'desc')->where('user_id',$id);
        if(!empty($status))
            $sql->where('status',"!=","APPROVED");
        $kycdocuments = $sql->get();               
        return $kycdocuments;
    }
}
