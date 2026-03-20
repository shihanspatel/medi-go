<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    protected $fillable = ['contact_id', 'reply_message'];

    public function contact()
    {
        return $this->belongsTo(ContactUs::class);
    }
}
