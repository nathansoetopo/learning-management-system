<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DetachCertificate extends Mailable
{
    use Queueable, SerializesModels;

    public $class, $user, $condition;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($condition, $class, $user)
    {
        $this->class = $class;
        $this->user = $user;
        $this->condition = $condition;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Informasi Sertifikat Amikom Center',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.detachcertificate',
            with: [
                'class' => $this->class,
                'user' => $this->user,
                'condition' => $this->condition,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
