<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenDocuments extends Model
{
   	protected $fillable = [        
        'document_name',
        'document',
        'order',
        'status',        
    ];
}
