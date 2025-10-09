<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Receipt #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Order Receipt</h2>
        <p>Order #{{ $order->id }}</p>
        <p>{{ $order->created_at->format('d M Y, h:i A') }}</p>
    </div>

    <h4>Customer Details</h4>
    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>

    <h4>Tickets</h4>
    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>Ticket Type</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Ticket Codes</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->ticket->event->title }}</td>
                <td>{{ $item->ticket->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->unit_price, 2) }}</td>
                <td>
                    @foreach($item->codes as $code)
                    <span>{{ $code->code }}</span>@if(!$loop->last), @endif
                    @endforeach
                </td>
                <td>${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" class="total">Total Amount</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>