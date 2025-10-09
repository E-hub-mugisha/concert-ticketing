<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    // Show all tickets after payment success
    public function showTicket($id)
    {
        $order = Order::with('items.ticket.event', 'items.codes')->findOrFail($id);

        return view('tickets.show', compact('order'));
    }

    // Generate individual ticket PDF
    public function downloadTicket($id)
    {
        $item = OrderItem::with('ticket.event', 'codes')->findOrFail($id);

        $pdf = Pdf::loadView('tickets.pdf', compact('item'));

        return $pdf->download('ticket_' . $item->id . '.pdf');
    }

    // Send email with all ticket PDFs
    public static function sendTicketsByEmail(Order $order)
    {
        $pdfs = [];

        foreach ($order->items as $item) {
            $pdf = Pdf::loadView('tickets.pdf', compact('item'))->output();
            $pdfs[] = [
                'filename' => 'ticket_' . $item->id . '.pdf',
                'content' => $pdf,
            ];
        }

        Mail::to($order->customer_email)->send(new TicketMail($order, $pdfs));
    }

    // Show all tickets for an order
    public function showOrderTickets(Order $order)
    {
        $order->load('items.ticket.event', 'items.codes');
        return view('tickets.adminShow', compact('order'));
    }

    

    // Send single ticket via email
    public function sendTicketEmail(Request $request, OrderItem $item)
    {
        $item->load('ticket.event', 'codes', 'order');
        $pdf = Pdf::loadView('tickets.pdf', compact('item'));

        Mail::send([], [], function($message) use ($item, $pdf) {
            $message->to($item->order->customer_email)
                ->subject('Your Ticket: '.$item->ticket->name)
                ->attachData($pdf->output(), 'ticket_'.$item->id.'.pdf')
                ->setBody('Please find your ticket attached.', 'text/html');
        });

        return back()->with('success', 'Ticket sent to '.$item->order->customer_email);
    }
}
