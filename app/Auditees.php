<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditees extends Model
{
    protected $fillable = [
        'agency_id', 'password','username', 'email', 'role' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'auditees';
}
