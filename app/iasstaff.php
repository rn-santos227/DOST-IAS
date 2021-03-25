<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class iasstaff extends Model
{
    protected $fillable = [
        'user_id', 'title','name', 'email', 'username', 'position', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'iasstaff';
}
