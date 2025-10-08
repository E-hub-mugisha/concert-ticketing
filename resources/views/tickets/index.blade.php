@extends('layouts.app')
@section('title', 'Manage Tickets')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Ticket Management</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTicketModal">
            <i class="bi bi-plus-circle me-1"></i> Add Ticket
        </button>
    </div>

    {{-- Ticket Table --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Event</th>
                            <th>Ticket Name</th>
                            <th>Price ($)</th>
                            <th>Quantity</th>
                            <th>Sold</th>
                            <th>Remaining</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ticket->event->title }}</td>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ number_format($ticket->price, 2) }}</td>
                                <td>{{ $ticket->quantity }}</td>
                                <td>{{ $ticket->sold }}</td>
                                <td class="fw-bold text-success">{{ $ticket->quantity - $ticket->sold }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#showTicketModal{{ $ticket->id }}"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editTicketModal{{ $ticket->id }}"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTicketModal{{ $ticket->id }}"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>

                            {{-- Show Modal --}}
                            <div class="modal fade" id="showTicketModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="showTicketModalLabel{{ $ticket->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4">
                                        <div class="modal-header bg-primary text-white rounded-top-4">
                                            <h5 class="modal-title" id="showTicketModalLabel{{ $ticket->id }}">Ticket Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Event:</strong> {{ $ticket->event->title }}</p>
                                            <p><strong>Name:</strong> {{ $ticket->name }}</p>
                                            <p><strong>Price:</strong> ${{ number_format($ticket->price, 2) }}</p>
                                            <p><strong>Quantity:</strong> {{ $ticket->quantity }}</p>
                                            <p><strong>Sold:</strong> {{ $ticket->sold }}</p>
                                            <p><strong>Remaining:</strong> {{ $ticket->quantity - $ticket->sold }}</p>
                                            <p><strong>Created:</strong> {{ $ticket->created_at->format('d M Y, h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editTicketModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="editTicketModalLabel{{ $ticket->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4">
                                        <div class="modal-header bg-success text-white rounded-top-4">
                                            <h5 class="modal-title">Edit Ticket</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Event</label>
                                                    <select name="event_id" class="form-select" required>
                                                        @foreach($events as $event)
                                                            <option value="{{ $event->id }}" {{ $ticket->event_id == $event->id ? 'selected' : '' }}>
                                                                {{ $event->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Ticket Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $ticket->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Price</label>
                                                    <input type="number" name="price" step="0.01" class="form-control" value="{{ $ticket->price }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" name="quantity" class="form-control" value="{{ $ticket->quantity }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="deleteTicketModal{{ $ticket->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4">
                                        <div class="modal-header bg-danger text-white rounded-top-4">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Are you sure you want to delete <strong>{{ $ticket->name }}</strong> for <strong>{{ $ticket->event->title }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST">
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
                                <td colspan="8" class="text-center text-muted">No tickets available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addTicketModal" tabindex="-1" aria-labelledby="addTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Add New Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.tickets.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Event</label>
                        <select name="event_id" class="form-select" required>
                            <option value="">Select Event</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ticket Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" step="0.01" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
