<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verify Your Medi-Go Account')
            ->view('emails.Email_user', [
                'name' => $notifiable->name,
                'actionUrl' => $verificationUrl,
            ]);
    }
}