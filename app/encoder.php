<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class encoder extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'password', 'username', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'encoder';
}
