<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageReceive extends Mailable
{
    use Queueable, SerializesModels;

    protected $sent_user, $receive_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sent_user, $receive_user)
    {
        $this->sent_user    = $sent_user;
        $this->receive_user = $receive_user;
    }

    /**
     * Build the message.s
     *
     * @return $this
     */
    public function build()
    {
        $url = '';
        if($this->receive_user['status'] == 0) {
            $url = '/mypage/u/messages/' . $this->receive_user['id'];
        } else {
            $url = '/mypage/t/messages/' . $this->receive_user['id'];
        }
        return $this
            ->subject('【おけいcom】メッセージ受信のお知らせ')
            ->view('emails.message-receive')
            ->with([
                'url'       => $url,                // URL
                'senter'    => $this->sent_user,    // 送信ユーザー情報
                'receiver'  => $this->receive_user, // 受信ユーザー情報
            ]);
    }
}
