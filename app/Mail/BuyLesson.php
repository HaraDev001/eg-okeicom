<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyLesson extends Mailable
{
    use Queueable, SerializesModels;

    protected $teacher, $lesson;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teacher, $lesson)
    {
        $this->teacher = $teacher;
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
            ->subject('【おけいcom】レッスン購入のお知らせ')
            ->view('emails.buy-lesson')
            ->with([
                'teacher'    => $this->teacher,         // ユーザー情報
                'lesson_id'  => $this->lesson->id,      // 出金情報
                'title'      => $this->lesson->title,   // タイトル
                'start'      => date('Y年n月j日 g時i分s秒', strtotime($this->lesson->start)),    // レッスン開始時間
                'finish'     => date('Y年n月j日 g時i分s秒', strtotime($this->lesson->finish)),   // レッスン終了時間
            ]);
    }
}
