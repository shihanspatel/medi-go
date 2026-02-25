<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Register extends Authenticatable
{
    protected $table = 'register';

    protected $fillable = [
        'name',
        'birth_date',
        'email',
        'password',
        'address',
        'city',
        'state',
        'pincode'
    ];

    protected $hidden = [
        'password'
    ];
}