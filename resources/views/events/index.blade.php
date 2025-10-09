@extends('layouts.app')
@section('title', 'Manage Events')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <i class="bi bi-calendar-event text-primary me-2"></i> Event Management
        </h3>
        <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addEventModal">
            <i class="bi bi-plus-circle me-1"></i> Add Event
        </button>
    </div>

    <!-- Event Table -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-light py-3 rounded-top-4">
            <h6 class="mb-0 fw-semibold text-primary">
                <i class="bi bi-list-ul me-1"></i> All Events
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0" id="eventTable">
                    <thead class="table-primary text-nowrap">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Venue</th>
                            <th>Date</th>
                            <th>Capacity</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                        class="rounded-3 border shadow-sm" style="width: 70px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="fw-semibold">{{ $event->title }}</td>
                                <td>{{ $event->venue }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, h:i A') }}</td>
                                <td>{{ $event->capacity }}</td>
                                <td>{{ Str::limit($event->description, 50) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#showEventModal{{ $event->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $event->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteEventModal{{ $event->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Show Modal -->
                            <div class="modal fade" id="showEventModal{{ $event->id }}" tabindex="-1" aria-labelledby="showEventLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content border-0 rounded-4 shadow-lg">
                                        <div class="modal-header bg-primary text-white rounded-top-4">
                                            <h5 class="modal-title fw-semibold" id="showEventLabel{{ $event->id }}">{{ $event->title }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid rounded-3 mb-3" alt="{{ $event->title }}">
                                            <ul class="list-unstyled">
                                                <li><strong>Venue:</strong> {{ $event->venue }}</li>
                                                <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, h:i A') }}</li>
                                                <li><strong>Capacity:</strong> {{ $event->capacity }}</li>
                                            </ul>
                                            <p class="mt-3">{{ $event->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" aria-labelledby="editEventLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4 shadow-lg">
                                        <div class="modal-header bg-success text-white rounded-top-4">
                                            <h5 class="modal-title fw-semibold">Edit Event</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
                                                    <label>Title</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="venue" class="form-control" value="{{ $event->venue }}" required>
                                                    <label>Venue</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="datetime-local" name="event_date" class="form-control" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') }}" required>
                                                    <label>Date</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="capacity" class="form-control" value="{{ $event->capacity }}">
                                                    <label>Capacity</label>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <textarea name="description" class="form-control" style="height: 100px;">{{ $event->description }}</textarea>
                                                    <label>Description</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success rounded-pill">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteEventModal{{ $event->id }}" tabindex="-1" aria-labelledby="deleteEventLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4 shadow">
                                        <div class="modal-header bg-danger text-white rounded-top-4">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center py-4">
                                            <p>Are you sure you want to delete <strong>{{ $event->title }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer border-0 justify-content-center">
                                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger rounded-pill px-4">Delete</button>
                                            </form>
                                            <button class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No events available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-semibold">Add New Event</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Event title" required>
                        <label>Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="venue" class="form-control" placeholder="Event venue" required>
                        <label>Venue</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="datetime-local" name="event_date" class="form-control" required>
                        <label>Date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="capacity" class="form-control" placeholder="Capacity">
                        <label>Capacity</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="description" class="form-control" placeholder="Description" style="height: 100px;"></textarea>
                        <label>Description</label>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary rounded-pill px-4">Save Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
