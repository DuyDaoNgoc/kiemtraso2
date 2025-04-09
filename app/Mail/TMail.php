<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TMail extends Mailable
{
    use Queueable, SerializesModels;

    public $Tmail;

    /**
     * Create a new message instance.
     */
    public function __construct($Tmail)
    {
        $this->Tmail = $Tmail;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.interfaceEmail')
                    ->with([
                        'Tmail' => $this->Tmail,
                    ]);
    }
}   