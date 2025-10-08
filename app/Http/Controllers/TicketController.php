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

    /**
     * Display a listing of tickets.
     */
    public function index()
    {
        $tickets = Ticket::with('event')->latest()->get();
        $events = Event::latest()->get();

        return view('tickets.index', compact('tickets', 'events'));
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        Ticket::create([
            'event_id' => $request->event_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'sold' => 0,
        ]);

        return redirect()->back()->with('success', 'Ticket created successfully!');
    }

    /**
     * Update the specified ticket in storage.
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket->update([
            'event_id' => $request->event_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Ticket updated successfully!');
    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->back()->with('success', 'Ticket deleted successfully!');
    }
}
