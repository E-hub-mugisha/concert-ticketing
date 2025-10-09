@extends('layouts.app')
@section('title', 'Tickets Purchased')

@section('content')
<div class="container py-4">
    <h3 class="text-primary mb-4">Tickets Purchased for Order #{{ $order->id }}</h3>

    <div class="row g-3">
        @foreach($order->items as $item)
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $item->ticket->event->title ?? '-' }}</h5>
                    <p class="mb-1"><strong>Ticket Type:</strong> {{ $item->ticket->name }}</p>
                    <p class="mb-1"><strong>Attendee:</strong> {{ $item->attendee_name }}</p>
                    <p class="mb-1"><strong>Code(s):</strong>
                        @foreach($item->codes as $code)
                            {{ $code->code }}<br>
                        @endforeach
                    </p>
                    <p class="mb-2"><strong>Price:</strong> ${{ number_format($item->unit_price, 2) }}</p>

                    <div class="d-flex gap-2">
                        <a href="{{ route('tickets.download', $item->id) }}" class="btn btn-sm btn-success">
                            <i class="bi bi-download"></i> Download
                        </a>

                        <form action="{{ route('tickets.email', $item->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-primary" type="submit">
                                <i class="bi bi-envelope"></i> Send Email
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
