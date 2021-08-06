<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LessonDetail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $lesson;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $lesson)
    {
        $this->user = $user;
        $this->lesson = $lesson;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('【おけいcom】レッスン購入完了のお知らせ')
            ->view('emails.detail-lessons')
            ->with([
                'user'       => $this->user,        // ユーザー情報
                'lesson_id'  => $this->lesson->id,  // 出金情報
            ]);
    }
}
