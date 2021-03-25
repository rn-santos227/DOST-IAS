<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class form_001_audit_report extends Model
{
    protected $fillable = [
        'audit_form_id', 'agency_id', 'pap', 'supervisor', 'tleader_id', 'amember_id', 'overseer', 'secretariat_id', 'datefrom', 'dateto', 'scope_audit',
        'auditees', 'background', 'goodpoint', 'author_id', 'status', 'open', 'close', 'for_management_action', 'receiver'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $table = 'form_001';
}
