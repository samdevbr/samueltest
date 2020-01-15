<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    protected $collection = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
