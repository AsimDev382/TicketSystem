<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Notifications\NewTicketNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendNewTicketNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticket; // Define the ticket property
    /**
     * Create a new job instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket; // Assign ticket to the property
    }

    /**
     * Execute the job.
     */
    public function handle()
{
    Auth::user()->notify(new NewTicketNotification($this->ticket));
}
}
