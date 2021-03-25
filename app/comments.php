<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $fillable = [
        'form_001_id', 'auditfinding_no','comment', 'comment_type', 'comment_by', 'status',
        ];

    protected $table = 'comments';
}
