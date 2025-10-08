<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function welcome()
    {
        // Fetch the latest events with tickets
        $events = Event::with('tickets')->get();
        $featuredEvent = Event::with('tickets')
        ->whereDate('event_date', '>=', now())
        ->orderBy('event_date', 'asc')
        ->first();

        return view('home', compact('events', 'featuredEvent'));
    }
}
