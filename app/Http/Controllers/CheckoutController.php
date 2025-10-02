<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // 1️⃣ Validate request
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
            'attendees' => 'required|array|min:1',
            'attendees.*' => 'required|string',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        // 2️⃣ Get the ticket
        $ticket = Ticket::findOrFail($request->ticket_id);

        // 3️⃣ Check ticket availability
        if ($request->quantity > ($ticket->quantity - $ticket->sold)) {
            return back()->withErrors(['quantity' => 'Not enough tickets available.']);
        }

        // 4️⃣ Create the order
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_amount' => $request->total_amount,
            'payment_status' => 'pending',
        ]);

        // 5️⃣ Create order items and ticket codes
        foreach ($request->attendees as $attendee) {
            // Each attendee is one ticket
            $orderItem = $order->items()->create([
                'ticket_id' => $ticket->id,
                'attendee_name' => $attendee,
                'quantity' => 1,
                'unit_price' => $ticket->price, // ✅ Correct field name
            ]);

            // Generate unique ticket code
            TicketCode::create([
                'order_item_id' => $orderItem->id,
                'code' => strtoupper(uniqid('TCKT')),
            ]);
        }

        // 6️⃣ Update ticket sold count
        $ticket->increment('sold', $request->quantity);

        // 7️⃣ Redirect to order summary or payment page
        return redirect()->route('order.summary', $order->id)
            ->with('success', 'Order created! Proceed to payment.');
    }



    public function summary(Order $order)
    {
        $order->load('items.ticket.event'); // eager load related data
        return view('orders.summary', compact('order'));
    }

    public function paymentCallback(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $txRef = $request->tx_ref;

        // Verify payment with Flutterwave API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('FLUTTERWAVE_SECRET_KEY')
        ])->get("https://api.flutterwave.com/v3/transactions/verify_by_reference?tx_ref={$txRef}");

        $data = $response->json();

        if ($data['status'] === 'success' && $data['data']['status'] === 'successful') {
            $order->update([
                'payment_status' => 'paid',
                'payment_reference' => $data['data']['id']
            ]);

            return redirect()->route('order.summary', $order->id)
                ->with('success', 'Payment successful!');
        }

        $order->update(['payment_status' => 'failed']);

        return redirect()->route('order.summary', $order->id)
            ->with('error', 'Payment failed!');
    }
}
