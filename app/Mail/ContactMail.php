<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $validated;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($validated)
    {
        $this->validated = $validated;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this
        //     ->view('emails.contact')
        //     ->subject('お問い合わせ完了【おけいcom】')
        //     ->with([
        //         'orderName' => $this->contact->name,
        //     ]);

        // return $this->text('emails.'.$this->viewStr)
        //     ->to($this->content['to'], $this->content['to_name'])
        //     ->from($this->content['from'], $this->content['from_name'])
        //     ->subject($this->content['subject'])
        //     ->with([
        //         'content' => $this->content['body'],
        //         'image' => $this->content['image'],
        //     ]);

        if(isset($this->validated['img'])) {
            return $this
                ->from('info@okeicom.com')
                ->subject('【おけいcom】自動返信 お問い合わせ完了のお知らせ')
                ->view('emails.to')
                ->attach($this->validated['img'])
                ->with([
                    'content' => $this->validated,  // バリデーション情報
                ]);
        } else {
            return $this
                ->from('info@okeicom.com')
                ->subject('【おけいcom】自動返信 お問い合わせ完了のお知らせ')
                ->view('emails.to')
                ->with([
                    'content' => $this->validated,  // バリデーション情報
                ]);
        }

    }
}
