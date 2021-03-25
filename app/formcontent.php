<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class formcontent extends Model
{
    protected $fillable = [
        'form_001_id', 'auditfinding_no', 'author_id', 'audit_area', 'custom_auditarea', 'sub_auditarea', 'auditfinding', 'auditrecommend', 'auditmanageaction', 'status', 'action_by', 'archive_status', 'main_area', 'custom_subauditarea', 'subof'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $table = 'form_content';
}
