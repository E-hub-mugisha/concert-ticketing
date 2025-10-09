@extends('layouts.guest')
@section('title', 'Your Tickets')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary fw-bold">Your Tickets</h2>

    <div class="alert alert-success d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        Payment confirmed! Download your tickets below or check your email for attached copies.
    </div>

    <div class="row g-4">
        @foreach($order->items as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 ticket-card">
                
                {{-- Event Image --}}
                @if($item->ticket->event->image)
                <img src="{{ asset('storage/' . $item->ticket->event->image) }}" class="card-img-top rounded-top-4" alt="{{ $item->ticket->event->title }}" style="height: 180px; object-fit: cover;">
                @endif

                <div class="card-body">
                    {{-- Event Info --}}
                    <h5 class="fw-bold mb-2">{{ $item->ticket->event->title }}</h5>
                    <p class="mb-1"><i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($item->ticket->event->event_date)->format('d M Y, h:i A') }}</p>
                    <p class="mb-1"><i class="bi bi-geo-alt me-1"></i> {{ $item->ticket->event->venue }}</p>

                    {{-- Attendee Info --}}
                    <hr>
                    <p class="mb-1"><strong>Attendee:</strong> {{ $item->attendee_name }}</p>
                    <p class="mb-1"><strong>Ticket:</strong> {{ $item->ticket->name }}</p>
                    <p class="mb-3"><strong>Code:</strong> {{ $item->codes->pluck('code')->implode(', ') }}</p>

                    {{-- QR Code --}}
                    <div class="mb-3 text-center">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $item->codes->pluck('code')->implode(',') }}" alt="QR Code">
                    </div>

                    {{-- Buttons --}}
                    <div class="d-grid gap-2">
                        <a href="{{ route('tickets.download', $item->id) }}" class="btn btn-outline-primary">
                            <i class="bi bi-download me-1"></i> Download Ticket
                        </a>
                        
                    </div>
                </div>

                {{-- Footer --}}
                <div class="card-footer d-flex justify-content-between align-items-center text-muted">
                    <small>Paid: ${{ number_format($item->unit_price, 2) }}</small>
                    <span class="badge bg-primary text-white">{{ $item->ticket->name }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Optional: Add hover effect for cards --}}
<style>
.ticket-card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
}
</style>
@endsection
