<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCta extends Model
{
    protected $table = 'about_ctas';

    protected $fillable = [
        'heading',
        'description',
        'button_text',
        'button_link',
        'status'
    ];
}
