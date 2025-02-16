<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Http\Resources\User;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyAddedNotification;
use App\Notifications\NewReplyNotification;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{

    // public function store(Request $request, $ticketId)
    // {

    //     // Find the ticket
    //     $ticket = Ticket::findOrFail($ticketId);
    //       // Create the reply
    //       $reply = new Reply();
    //       $reply->message = $request->message;
    //       $reply->ticket_id = $ticket->id;
    //       $reply->user_id = Auth::id();
    //       $reply->save();

    //       // Notify the ticket owner (if the replier is not the owner)
    //       if ($ticket->user->id == Auth::id()) {
    //           // Send the notification
    //           $ticket->user->notify(new NewReplyNotification($reply));
    //       }

    //     return redirect()->back()->with('success', 'Reply added successfully.');
    // }


    public function store(ReplyRequest $request, $ticketId)
{
    // Find the ticket
    $ticket = Ticket::findOrFail($ticketId);

    // Create the reply
    $reply = new Reply();
    $reply->message = $request->message;
    $reply->ticket_id = $ticket->id;
    $reply->user_id = Auth::id();
    $reply->save();

    // Notify the ticket owner (if the replier is not the owner)
    if ($ticket->user->id == Auth::id()) {
        $ticket->user->notify(new NewReplyNotification($reply));
    }

    session()->flash('success', 'Reply added successfully.');
    // If the request is AJAX, return a JSON response
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'msg' => 'Reply added successfully.',
            'reply' => [
                'message' => $reply->message,
                'created_at' => $reply->created_at->diffForHumans(),
            ],
            'user' => [
                'name' => Auth::user()->name
            ]
        ]);
    }

}


}

