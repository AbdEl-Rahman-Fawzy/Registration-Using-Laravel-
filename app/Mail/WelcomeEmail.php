<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailmessage;
    public $subject1;

    /**
     * Create a new message instance.
     */
    public function __construct($email,$userName)
    {
        return $this->view('mail.new_registered_user',['variableName' => $userName,'variableEmail' => $email])->subject("New Registered User");
    }

    /**
     * Build the message.
     */
    /*public function build()
    {
        return $this->from('hazemnasser3050@gmail.com', 'Hazem Nasser')
                    ->view('mail_template.registration')
                    ->with([
                        'message' => $this->mailmessage,
                    ])
                    ->subject($this->subject1);
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Our Platform',
        );
    }*/

}
