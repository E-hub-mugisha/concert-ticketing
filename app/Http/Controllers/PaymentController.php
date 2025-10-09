<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\TicketController;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('order.items.ticket.event','order.items.codes')->latest()->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function callback(Request $request)
    {
        $tx_ref = $request->get('tx_ref'); // e.g., "5-12-1721123456789"
        $status = $request->get('status');
        $order_id = $request->get('order_id');
        $data = $request->get('data', []);

        // Check if the transaction already exists
        if (Payment::where('transaction_id', $tx_ref)->exists()) {
            return redirect()->back()->with('info', 'Payment already processed.');
        }

        $order = Order::findOrFail($order_id);

        // ✅ Save payment record
        Payment::updateOrCreate([
            'transaction_id' => $tx_ref,
            'order_id' => $order->id,
            'status' => $status,
            'amount' => $order->total_amount,
            'currency' => 'RWF',
            'payment_method' => 'Flutterwave',
            'processor_response' => $status,
            'meta' => $request->all(),
        ]);

        // ✅ Update order
        $order->update([
            'payment_status' => 'paid',
            'transaction_id' => $data['transaction_id'] ?? $tx_ref,
        ]);

        if ($status === 'successful') {

            // ✅ Send tickets to email
            TicketController::sendTicketsByEmail($order);

            return redirect()->route('order.tickets', $order->id)->with('success', 'Payment successful! Your tickets are confirmed.');
        }

        return redirect()->route('order.summary', $order->id)->with('error', 'Payment verification failed. Please try again.');
    }
}
