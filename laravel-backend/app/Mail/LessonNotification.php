<?php

namespace App\Mail;

use App\Models\Les;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LessonNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $les;
    public $messageType;

    public function __construct(Les $les, $messageType = 'created')
    {
        $this->les = $les;
        $this->messageType = $messageType;
    }

    public function build()
    {
        return $this->view('emails.lesson_notification')
            ->subject('Les ' . ucfirst($this->messageType))
            ->with([
                'lesson' => $this->les,
                'messageType' => $this->messageType,
            ]);
    }
}
