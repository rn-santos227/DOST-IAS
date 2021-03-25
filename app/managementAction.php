<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class managementAction extends Model
{
    protected $fillable = [
        'form_001_id', 'auditfinding_no', 'idate', 'imanagement_action', 'imonitoring_mgtaction', 'immgtaction_date', 'istatus', 'iauthor', 'fdate', 'fmanagement_action',
        'fmonitoring_mgtaction', 'fmmgtaction_date', 'fstatus', 'fauthor', 'sdate', 'smanagement_action', 'smonitoring_mgtaction', 'smmgtaction_date', 'sstatus', 'sauthor', 'tdate',
        'tmanagement_action', 'tmonitoring_mgtaction', 'tmmgtaction_date', 'tstatus', 'tauthor', 'monitoring_stage', 'final_status'
        ];

    protected $table = 'action_monitoring';
}
