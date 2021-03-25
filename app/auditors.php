<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class auditors extends Model
{
    protected $fillable = [
        'user_id', 'title','name', 'email', 'username', 'agency', 'position', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'auditors';
}
