@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Page Header --}}
            <div class="mb-4 text-center">
                <h1 class="fw-bold text-primary">Order Summary</h1>
                <p class="text-muted">Review your ticket details and payment information below.</p>
            </div>

            {{-- Customer Info Card --}}
            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body">
                    <h5 class="fw-semibold mb-3 text-primary">Customer Details</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Name:</strong> {{ $order->customer_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Email:</strong> {{ $order->customer_email }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tickets Table Card --}}
            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body">
                    <h5 class="fw-semibold mb-3 text-primary">Tickets Purchased</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Attendee</th>
                                    <th>Ticket</th>
                                    <th>Price</th>
                                    <th>Ticket Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->attendee_name }}</td>
                                    <td>{{ $item->ticket->name }}</td>
                                    <td>${{ number_format($item->unit_price, 2) }}</td>
                                    <td>
                                        @foreach($item->codes as $code)
                                        <span class="badge bg-secondary">{{ $code->code }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Total & Actions --}}
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <h4 class="fw-bold text-success mb-4">Total Paid: ${{ number_format($order->total_amount, 2) }}</h4>
                    <div class="btn-group-custom">
                        <button id="payBtn" class="btn front-btn-ticket"> <span id="payBtnText"><i class="fa fa-money-bill-wave"></i> Pay Now</span> <span id="payBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> </button> <button class="btn btn-cancel w-100" onclick="window.history.back();"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const payBtn = document.getElementById("payBtn");
        const payBtnText = document.getElementById("payBtnText");
        const payBtnSpinner = document.getElementById("payBtnSpinner");

        if (!payBtn) return;

        payBtn.addEventListener("click", function() {
            // Show spinner
            payBtnText.textContent = "Processing Payment...";
            payBtnSpinner.classList.remove("d-none");
            payBtn.disabled = true;

            if (typeof FlutterwaveCheckout === "undefined") {
                alert("Payment script not loaded yet.");
                payBtnText.innerHTML = '<i class="fa fa-money-bill-wave"></i> Pay Now';
                payBtnSpinner.classList.add("d-none");
                payBtn.disabled = false;
                return;
            }

            const userEmail = "{{ $order->customer_email }}";
            const orderId = "{{ $order->id }}";

            FlutterwaveCheckout({
                public_key: "{{ env('FLW_PUBLIC_KEY') }}",
                tx_ref: "TCKT{{ $order->id }}_{{ uniqid() }}",
                amount: 5.00, // For testing, set a fixed amount like 5.00
                currency: "RWF",
                payment_options: "card, ussd, banktransfer",
                customer: {
                    email: "{{ $order->customer_email }}",
                    name: "{{ $order->customer_name }}",
                    phone_number: "{{ $order->customer_phone }}"
                },
                callback: function(data) {
                    window.location.href = `/concert/payment/callback?order_id=${orderId}&email=${encodeURIComponent(userEmail)}&status=${encodeURIComponent(data.status)}&tx_ref=${encodeURIComponent(data.tx_ref)}`;
                },
                onclose: function() {
                    payBtnText.innerHTML = '<i class="fa fa-money-bill-wave"></i> Pay Now';
                    payBtnSpinner.classList.add("d-none");
                    payBtn.disabled = false;
                },
                customizations: {
                    title: "Concert Tickets",
                    description: "Payment for tickets to {{ $order->items->first()->ticket->event->name }}",
                    logo: "{{ asset('logo.png') }}"
                }
            });
        });
    });
</script>
@endsection