<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerify extends Mailable
{
    use Queueable, SerializesModels;

    protected $email_verification;

    /**
     * Create a new message instance.
     *
     * @param $email_verification
     * @return void
     */
    public function __construct($email_verification)
    {
        $this->email_verification = $email_verification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('【' . Config('app.name') . '】仮登録が完了しました')
            ->view('auth.email.verify')
            ->with(['token' => $this->email_verification->url_token,]);
    }
}
