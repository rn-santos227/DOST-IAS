<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agency extends Model
{
    protected $fillable = [
        'name', 'code','agencygroup', 'agencyhead', 'emailhead', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $table = 'agency';
}
