<?php

namespace App\Mail;

use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyAddedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $reply;

    public function __construct(Ticket $ticket, Reply $reply)
    {
        $this->ticket = $ticket;
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('New Reply on Your Support Ticket')
            ->view('emails.replyAdded')
            ->with([
                'ticket' => $this->ticket,
                'reply' => $this->reply,
            ]);
    }
}

