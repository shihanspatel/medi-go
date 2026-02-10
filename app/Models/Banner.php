<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'badge_text',
        'heading',
        'highlight_text',
        'description',
        'button_text',
        'image',
        'status'
    ];
}
