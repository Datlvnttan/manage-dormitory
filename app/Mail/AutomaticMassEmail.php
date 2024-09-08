<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AutomaticMassEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject, $contentView;
    public $host;
    public $port;
    
    public $encryption;
    public $username;
    public $password;
    public $transport;
    var $data;
    /**
     * Create a new message instance.
     */
    public function __construct($subject, $contentView,$data = null)
    {

        $this->host = 'smtp.gmail.com';
        $this->port = 587;
        $this->encryption = "tls";
        $this->username = 'Fackbookneww@gmail.com';
        $this->password = 'wauxmkeidjdkbryf';
        $this->transport = 'smtp';



        $this->subject = $subject;
        $this->contentView = $contentView;
        $this->data = $data;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->contentView,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    
}
