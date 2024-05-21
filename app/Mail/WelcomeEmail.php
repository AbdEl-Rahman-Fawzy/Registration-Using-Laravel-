<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailmessage;
    public $subject1;

    /**
     * Create a new message instance.
     */
    public function __construct($mailmessage, $subject)
    {
        $this->mailmessage = $mailmessage;
        $this->subject1 = $subject;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('hazemnasser3050@gmail.com', 'Hazem Nasser')
                    ->view('mail_template.registration')
                    ->with([
                        'message' => $this->mailmessage,
                    ])
                    ->subject($this->subject1);
    }
}
