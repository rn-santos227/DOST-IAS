<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class afrecommendation extends Model
{
   protected $fillable = [
        'form_001_id', 'auditfinding_no', 'subof_no', 'author_id',  'afrecommend', 'management_action', 'status', 'fauthor_id', 'first_fu', 'ffu_mgmtaction', 'ffu_status', 'ffu_updated_at', 'sauthor_id', 'second_fu', 'sfu_mgmtaction', 'sfu_status', 'sfu_updated_at', 'tauthor_id', 'third_fu', 'tfu_mgmtaction', 'tfu_status', 'tfu_updated_at', 'ffumgmt_updated_at', 'sfumgmt_updated_at', 'tfumgmt_updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $table = 'afrecommendation';
}
