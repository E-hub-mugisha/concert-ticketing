<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket #{{ $item->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap');

        body {
            font-family: 'Rubik', sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f9fc;
        }

        .ticket-container {
            width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .ticket-banner {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .ticket-header {
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            color: #fff;
            padding: 15px 20px;
            text-align: center;
        }

        .ticket-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .ticket-body {
            padding: 20px;
        }

        .ticket-body p {
            margin: 6px 0;
            font-size: 16px;
            color: #333;
        }

        .ticket-body strong {
            color: #0d6efd;
        }

        .ticket-footer {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 2px dashed #0d6efd;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        .qr-code img {
            width: 120px;
            height: 120px;
        }

        /* Optional print styling */
        @media print {
            body { background: #fff; }
            .ticket-container { box-shadow: none; margin: 0; }
        }
    </style>
</head>
<body>
    <div class="ticket-container">

        {{-- Event Banner --}}
        @if($item->ticket->event->image)
        <img src="{{ asset('storage/' . $item->ticket->event->image) }}" class="ticket-banner" alt="{{ $item->ticket->event->title }}">
        @endif

        <div class="ticket-header">
            <h2>{{ $item->ticket->event->title }}</h2>
        </div>

        <div class="ticket-body">
            <p><strong>Attendee:</strong> {{ $item->attendee_name }}</p>
            <p><strong>Ticket Type:</strong> {{ $item->ticket->name }}</p>
            <p><strong>Price:</strong> ${{ number_format($item->unit_price, 2) }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($item->ticket->event->event_date)->format('d M Y, h:i A') }}</p>
            <p><strong>Venue:</strong> {{ $item->ticket->event->venue }}</p>
            <p><strong>Ticket Code:</strong> {{ $item->codes->pluck('code')->implode(', ') }}</p>

            <div class="qr-code">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $item->codes->pluck('code')->implode(',') }}" alt="QR Code">
            </div>
        </div>

        <div class="ticket-footer">
            <span>Ticket ID: #{{ $item->id }}</span>
            <span class="fw-bold">Paid: ${{ number_format($item->unit_price, 2) }}</span>
        </div>
    </div>
</body>
</html>
