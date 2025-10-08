<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use App\Models\TicketCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.ticket'])->latest()->get();
        $tickets = Ticket::all();
        return view('orders.index', compact('orders', 'tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'nullable|string|max:20',
            'items' => 'required|array',
            'items.*.ticket_id' => 'required|exists:tickets,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'payment_status' => 'Pending',
                'total_amount' => 0,
            ]);

            $total = 0;

            foreach ($request->items as $item) {
                $ticket = Ticket::findOrFail($item['ticket_id']);
                $quantity = $item['quantity'];
                $price = $ticket->price;

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'ticket_id' => $ticket->id,
                    'quantity' => $quantity,
                    'unit_price' => $price,
                    'attendee_name' => $item['attendee_name'] ?? 'Attendee',
                ]);

                // Generate unique codes for each attendee/ticket
                for ($i = 0; $i < $quantity; $i++) {
                    TicketCode::create([
                        'order_item_id' => $orderItem->id,
                        'code' => strtoupper(Str::random(10)),
                    ]);
                }

                $total += $price * $quantity;
            }

            $order->update(['total_amount' => $total]);
        });

        return redirect()->back()->with('success', 'Order created successfully!');
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'payment_status' => 'required|in:Pending,Paid,Cancelled',
        ]);

        $order->update(['payment_status' => $request->payment_status]);
        return redirect()->back()->with('success', 'Order updated successfully!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully!');
    }

    public function show($id)
    {
        $order = Order::with('items.ticket')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function receipt($id)
    {
        $order = Order::with('items.codes', 'items.ticket.event')->findOrFail($id);

        $pdf = Pdf::loadView('orders.pdf', compact('order'));

        return $pdf->download('order_' . $order->id . '_receipt.pdf');
    }
}
