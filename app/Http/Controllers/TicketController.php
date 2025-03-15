<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
// use App\Http\Resources\User;
use App\Jobs\SendNewTicketNotificationJob;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewTicketNotification;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class TicketController extends Controller
{
    public function index()
    {
        $users = User::all();

        if (auth()->user()->role == 'admin') {
            // Admins see all tickets
            $tickets = Ticket::all();
            // $tickets = Ticket::with('user')->get();
        } else {
            // Users see only their own tickets
            $tickets = Ticket::where('user_id', auth()->id())->get();
            // $tickets = Ticket::with('user')->where('user_id', auth()->id())->get();
        }

        return view('admin.tickets.index', compact('tickets', 'users'));
    }

    public function create()
    {
        // $this->authorize('create', Ticket::class);
        return view('admin.tickets.create');
    }


    // public function store(Request $request)
    // {
    //     // $this->authorize('create', Ticket::class);

    //     $ticket = new Ticket();
    //     $ticket->title = $request->title;
    //     $ticket->description = $request->description;
    //     $ticket->priority = $request->priority;
    //     $ticket->user_id = auth()->id();

    //     if ($request->hasFile('attachment')) {
    //         $ticket->attachment = $request->file('attachment')->store('attachments');
    //     }

    //     $ticket->save();
    //     Auth::user()->notify(new NewTicketNotification($ticket));

    //     return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
    // }

    public function store(TicketRequest $request)
    {
        // Store the ticket
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->priority = $request->priority;
        $ticket->user_id = auth()->id();
        $ticket->ticket_id = rand(1000, 99999);

        $latestTicket = Ticket::latest('id')->first();
        $number = $latestTicket ? ($latestTicket->id + 1) : 1;
        $ticket->ticket_id = 'TKT-' . str_pad($number, 2, '0', STR_PAD_LEFT);

        if ($request->hasFile('attachment')) {
            $ticket->attachment = $request->file('attachment')->store('attachments', 'public');
        }

        $ticket->save();

        // Auth::user()->notify(new NewTicketNotification($ticket));
        // SendNewTicketNotificationJob::dispatch($ticket);

        session()->flash('success', 'Ticket created successfully!');

        // Return JSON response for AJAX
        return response()->json(['success' => true, 'message' => 'Ticket created successfully!']); // Return JSON response on success
    }



    public function show($id)
    {
        $ticket = Ticket::with('replies.user')->findOrFail($id);
        Gate::authorize('view', $ticket);

        return view('admin.tickets.show', compact('ticket'));
    }



    public function updateStatus(Ticket $ticket, Request $request)
    {
        $ticket->status = $request->status;
        $ticket->save();

        return back()->with('success', 'Ticket status updated successfully.');
    }


    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully');
    }


    public function filter(Request $request)
    {
        // Retrieve filter inputs
        $status = $request->get('status');
        $priority = $request->get('priority');
        $date = $request->get('date');
        $user = $request->get('user');
        $ticket_id = $request->get('ticket_id');

        $role = auth()->user()->role;
        $user_id = auth()->user()->id;
        // Query to filter tickets
        $query = Ticket::query();
        // $query = Ticket::with('user');

        if ($role == 'admin') {

            if ($status) {
                $query->where('status', $status);
            }

            if ($priority) {
                $query->where('priority', $priority);
            }

            if ($date) {
                $query->whereDate('created_at', $date);
            }
            if ($user) {
                $query->where('user_id', $user);
            }
            if ($ticket_id) {
                $query->where('ticket_id', $ticket_id);
            }
        } else {
            if ($status) {
                $query->where('status', $status)->where('user_id', $user_id);
            }

            if ($priority) {
                $query->where('priority', $priority)->where('user_id', $user_id);
            }

            if ($date) {
                $query->whereDate('created_at', $date)->where('user_id', $user_id);
            }
            if ($user) {
                $query->where('user_id', $user);
            }
            if ($ticket_id) {
                $query->where('ticket_id', $ticket_id);
            }
        }
        $tickets = $query->get();


        // Return JSON response to be handled by AJAX
        return response()->json($tickets);
    }
}
