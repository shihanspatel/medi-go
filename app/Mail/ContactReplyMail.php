<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $replyMessage;
    public $userEmail;

    public function __construct($userName, $replyMessage, $userEmail)
    {
        $this->userName = $userName;
        $this->replyMessage = $replyMessage;
        $this->userEmail = $userEmail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reply to Your Contact Message - Medi-Go',
            to: $this->userEmail,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_reply',
            with: [
                'userName' => $this->userName,
                'replyMessage' => $this->replyMessage,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
