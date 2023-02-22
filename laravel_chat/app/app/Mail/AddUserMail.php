<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $params;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("確認帳號新增")
            ->view('emails.user')
            ->with([
                'params' => $this->params,
            ]);
    }
}
