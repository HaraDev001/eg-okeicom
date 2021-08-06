<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvaluationRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $lesson, $teacher, $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lesson, $teacher, $url)
    // public function __construct()
    {
        $this->lesson   = $lesson;
        $this->teacher  = $teacher;
        $this->url      = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('【おけいcom】メンバー評価のお願い')
            // ->subject('メンバー評価のお願い')
            ->view('emails.evaluation-request')
            ->with([
                'lesson'  => $this->lesson,   // レッスン情報
                'teacher' => $this->teacher,  // 講師情報
                'url'     => $this->url       // 講師情報
            ]);
    }
}
