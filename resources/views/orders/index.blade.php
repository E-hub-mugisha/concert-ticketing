@extends('layouts.app')
@section('title', 'Orders')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">Order Management</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrderModal">
            <i class="bi bi-plus-circle"></i> New Order
        </button>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tickets</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <span class="badge 
                                    @if($order->payment_status == 'Paid') bg-success
                                    @elseif($order->payment_status == 'Cancelled') bg-danger
                                    @else bg-warning text-dark
                                    @endif">
                                {{ $order->payment_status }}
                            </span>
                        </td>
                        <td>
                            <ul class="mb-0">
                                @foreach($order->items as $item)
                                <li>{{ $item->attendee_name }} - {{ $item->ticket->name }} (x{{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.orders.receipt', $order->id) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                <i class="bi bi-download"></i> Receipt
                            </a>

                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editOrder{{ $order->id }}"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteOrder{{ $order->id }}"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="editOrder{{ $order->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4">
                                <div class="modal-header bg-success text-white rounded-top-4">
                                    <h5>Update Payment Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <select name="payment_status" class="form-select">
                                            <option {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                            <option {{ $order->payment_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="deleteOrder{{ $order->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4">
                                <div class="modal-header bg-danger text-white rounded-top-4">
                                    <h5>Delete Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <strong>{{ $order->customer_name }}</strong>’s order?
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Order Modal --}}
<div class="modal fade" id="addOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5>Create New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.orders.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="customer_email" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Phone</label>
                            <input type="text" name="customer_phone" class="form-control">
                        </div>
                    </div>

                    <div id="ticketItems">
                        <div class="row g-3 align-items-end ticket-item">
                            <div class="col-md-5">
                                <label>Ticket</label>
                                <select name="items[0][ticket_id]" class="form-select" required>
                                    <option value="">-- Select Ticket --</option>
                                    @foreach($tickets as $ticket)
                                    <option value="{{ $ticket->id }}">{{ $ticket->name }} ({{ $ticket->price }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Quantity</label>
                                <input type="number" name="items[0][quantity]" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-3">
                                <label>Attendee</label>
                                <input type="text" name="items[0][attendee_name]" class="form-control">
                            </div>
                            <div class="col-md-1 text-center">
                                <button type="button" class="btn btn-danger btn-sm remove-item">×</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="addTicketItem" class="btn btn-outline-primary mt-3">
                        <i class="bi bi-plus"></i> Add Another Ticket
                    </button>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Create Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let itemIndex = 1;
    document.getElementById('addTicketItem').addEventListener('click', () => {
        const container = document.getElementById('ticketItems');
        const html = `
        <div class="row g-3 align-items-end ticket-item">
            <div class="col-md-5">
                <select name="items[${itemIndex}][ticket_id]" class="form-select" required>
                    <option value="">-- Select Ticket --</option>
                    @foreach($tickets as $ticket)
                        <option value="{{ $ticket->id }}">{{ $ticket->name }} ({{ $ticket->price }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control" min="1" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="items[${itemIndex}][attendee_name]" class="form-control">
            </div>
            <div class="col-md-1 text-center">
                <button type="button" class="btn btn-danger btn-sm remove-item">×</button>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        itemIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.ticket-item').remove();
        }
    });
</script>
@endsection