@extends('layouts.app')
@section('title', 'Order Details')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Order #{{ $order->id }}</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5>Customer Details</h5>
            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
            <p><strong>Transaction ID:</strong> {{ $order->transaction_id ?? '-' }}</p>
            <hr>

            <h5>Tickets Purchased</h5>
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Ticket</th>
                        <th>Attendee</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                        <th>Ticket Codes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->ticket->name ?? 'Deleted Ticket' }}</td>
                            <td>{{ $item->attendee_name ?? '-' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                            <td>
                                @if($item->codes->count())
                                    <ul class="list-unstyled mb-0">
                                        @foreach($item->codes as $code)
                                            <li>{{ $code->code }} <span class="badge bg-success">{{ $code->used ? 'Used' : 'Unused' }}</span></li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Total Amount:</th>
                        <th colspan="2">${{ number_format($order->total_amount, 2) }}</th>
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="card-footer bg-light text-end">
            <a href="{{ route('admin.orders.receipt', $order->id) }}" class="btn btn-primary">
                <i class="bi bi-download"></i> Download PDF
            </a>
        </div>
    </div>
</div>
@endsection
