<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function dashboard()
{
    $admin = auth()->user()->role;
    $user_id = auth()->user()->id;

    if($admin == 'admin'){
        $total_ticket = Ticket::all();
        $total_r= Ticket::where('status', 'Resolved')->get();
        $total_p= Ticket::where('status', 'In Progress')->get();
    }else{
        $total_ticket = Ticket::where('user_id', $user_id)->get();
        $total_r = Ticket::where('user_id', $user_id)->where('status', 'Resolved')->get();
        $total_p = Ticket::where('user_id', $user_id)->where('status', 'In Progress')->get();
    }
    // dd($total_ticket->count());

    return view('dashboard', compact('total_ticket', 'total_r', 'total_p'));

}
}
