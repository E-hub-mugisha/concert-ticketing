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

        return view('welcome', compact('events'));
    }
}
