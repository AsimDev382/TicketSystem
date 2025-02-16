<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Determine if the given ticket can be viewed by the user.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        // Users can view their own tickets, admins can view all tickets
        return $user->role == 'admin' || $user->id === $ticket->user_id;

    }

    /**
     * Determine if the user can create tickets.
     */
    public function create(User $user)
    {
        // All users can create tickets
        return $user->role == 'user';
    }

    /**
     * Determine if the user can update the status of the ticket.
     */
    public function updateStatus(User $user, Ticket $ticket)
    {
        // Users can update their own ticket status, admins can update all
        return $user->role == 'admin' || $user->id === $ticket->user_id;
    }

    /**
     * Determine if the user can delete the ticket.
     */
    public function delete(User $user, Ticket $ticket)
    {
        // Only admins can delete tickets
        return $user->role == 'admin';
    }

    /**
     * Determine if the user can view a list of all tickets.
     */
    public function viewAny(User $user)
    {
        //
    }
}

