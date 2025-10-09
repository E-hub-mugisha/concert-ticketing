@extends('layouts.app')
@section('title', 'Manage Payments')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Payments</h3>
    </div>

    <div class="card shadow border-0 rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center" id="paymentTable">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->order->customer_name }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $payment->status == 'success' ? 'success' : 'danger' }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#paymentDetailsModal{{ $payment->id }}">
                                    <i class="bi bi-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted text-center">No payments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($payments as $payment)
    {{-- Payment Details Modal --}}
    <div class="modal fade" id="paymentDetailsModal{{ $payment->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-receipt"></i> Payment Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fw-bold mb-3 text-primary">Customer Info</h5>
                    <p><strong>Name:</strong> {{ $payment->order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $payment->order->customer_email }}</p>
                    <p><strong>Phone:</strong> {{ $payment->order->customer_phone }}</p>

                    <hr>
                    <h5 class="fw-bold mb-3 text-success">Payment Info</h5>
                    <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($payment->amount, 2) }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-{{ $payment->status == 'success' ? 'success' : 'danger' }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </p>
                    <p><strong>Date:</strong> {{ $payment->created_at->format('d M Y, h:i A') }}</p>

                    <hr>
                    <h5 class="fw-bold mb-3 text-info">Tickets Purchased</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Event</th>
                                    <th>Ticket Type</th>
                                    <th>Attendee</th>
                                    <th>Code</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payment->order->items as $item)
                                <tr>
                                    <td>{{ $item->ticket->event->title ?? '-' }}</td>
                                    <td>{{ $item->ticket->name }}</td>
                                    <td>{{ $item->attendee_name }}</td>
                                    <td>
                                        @foreach($item->codes as $code)
                                        {{ $code->code }}<br>
                                        @endforeach
                                    </td>
                                    <td>${{ number_format($item->unit_price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.orders.receipt', $payment->order->id) }}" target="_blank" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf"></i> Download Receipt (PDF)
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection