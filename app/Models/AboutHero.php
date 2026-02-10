<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutHero extends Model
{
    protected $table = 'about_heroes';

    protected $fillable = [
        'subtitle',
        'heading',
        'highlight_text',
        'description',
        'image',
        'status'
    ];
}
