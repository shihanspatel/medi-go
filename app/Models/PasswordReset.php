<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = ['email', 'otp', 'otp_expires_at', 'otp_verified'];
    protected $casts = ['otp_expires_at' => 'datetime'];
}
