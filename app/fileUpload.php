<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fileUpload extends Model
{
    protected $fillable = [
        'form_001_id', 'auditfinding_no', 'filename', 'description', 'file', 'filetype', 'uploaded_by', 'status', 'archive_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $table = 'fileUpload';
}
