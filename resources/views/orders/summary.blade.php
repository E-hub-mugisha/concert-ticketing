@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <h1>Order Summary</h1>

    <h4>Customer: {{ $order->customer_name }}</h4>
    <h5>Email: {{ $order->customer_email }}</h5>
    <h5>Phone: {{ $order->customer_phone }}</h5>

    <table class="table table-bordered mt-3">
        <thead>
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
                    {{ $code->code }}<br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Paid: ${{ number_format($order->total_amount, 2) }}</h4>

    <button class="btn btn-success w-100 mt-3" id="payButton">Pay Now</button>
</div>

<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
document.getElementById('payButton').addEventListener('click', function () {
    FlutterwaveCheckout({
        public_key: "{{ env('FLUTTERWAVE_PUBLIC_KEY') }}",
        tx_ref: "TCKT{{ $order->id }}_{{ uniqid() }}",
        amount: {{ $order->total_amount }},
        currency: "USD",
        payment_options: "card, ussd, banktransfer",
        redirect_url: "{{ route('payment.callback', $order->id) }}",
        customer: {
            email: "{{ $order->customer_email }}",
            name: "{{ $order->customer_name }}",
            phone_number: "{{ $order->customer_phone }}"
        },
        customizations: {
            title: "Concert Tickets",
            description: "Payment for tickets to {{ $order->items->first()->ticket->event->name }}",
            logo: "{{ asset('logo.png') }}"
        }
    });
});
</script>
@endsection