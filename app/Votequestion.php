<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votequestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'questions',        
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

    public function votes()
    {
        return $this->hasOne('App\Vote', 'question_id')->where('user_id', \Auth::user()->id);
    }

    public function votechild()
    {
        return $this->hasMany('App\VoteQuestionChild', 'question_id','id');
    }
}
