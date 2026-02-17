<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $table = 'contact_settings';

    protected $fillable = [
        'badge_text',
        'heading',
        'subheading',
        'address_title',
        'address',
        'address_button_text',
        'address_link',
        'phone_title',
        'phone',
        'phone_hours',
        'email_title',
        'email',
        'email_description',
        'map_embed',
        'form_heading',
        'form_reply_time',
        'status'
    ];
}
