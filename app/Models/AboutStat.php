<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutStat extends Model
{
    protected $table = 'about_stats';

    protected $fillable = [
        'title',
        'value',
        'status'
    ];
}
