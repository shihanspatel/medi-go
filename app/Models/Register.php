<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomVerifyEmail;

class Register extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Table Name
    |--------------------------------------------------------------------------
    */
    protected $table = 'users';

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'name',
        'birth_date',
        'email',
        'password',
        'address',
        'city',
        'state',
        'pincode',
        'status',
        'role',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Fields
    |--------------------------------------------------------------------------
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',   // 🔥 Auto hash password (Laravel 10 feature)
    ];

    /*
    |--------------------------------------------------------------------------
    | Custom Email Verification Notification
    |--------------------------------------------------------------------------
    */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }
}