<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $request)
    {
        $this->user    = $user;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('【おけいcom】出金リクエスト完了のお知らせ')
            // ->subject('メンバー評価のお願い')
            ->view('emails.withdrawal-request')
            ->with([
                'user'    => $this->user,     // ユーザー情報
                'request' => $this->request,  // 出金情報
            ]);
    }
}
