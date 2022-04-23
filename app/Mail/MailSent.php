<?php

namespace App\Mail;

use App\Models\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSent extends Mailable
{
    use Queueable, SerializesModels;

    protected $mail;

    /**
     * Create a new message instance.
     *
     * @param  Mail  $mail
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config(''))
            ->subject($this->mail->subject)
            ->markdown('emails.email')
            ->with('mail', $this->mail);
    }
}
