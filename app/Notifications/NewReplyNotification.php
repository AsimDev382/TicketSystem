<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReplyNotification extends Notification
{
    use Queueable;

    protected $reply;


    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Reply to Your Ticket')
            ->line('A new reply has been added to your ticket.')
            ->action('View Ticket', route('tickets.show', $this->reply->ticket_id))
            ->line('Reply Message: ' . $this->reply->message)
            ->line('Thank you for using our application!');
    }

}
