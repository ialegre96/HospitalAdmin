<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarkdownMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     * @param  string  $view
     * @param  string  $subject
     * @param  array  $data
     *
     * @return void
     */
    public function __construct($view, $subject, $data = [])
    {
        $this->data = $data;
        $this->view = $view;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject($this->subject)
            ->markdown($this->view)
            ->with($this->data);

        if ($this->data['attachments']) {
            $mail->attach($this->data['attachments']);
        }

        return $mail;
    }
}
