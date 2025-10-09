<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Your Tickets</title>
</head>

<body>
    <h2>Hello {{ $order->customer_name }},</h2>
    <p>Thank you for your purchase! 🎉</p>
    <p>Your tickets for the event(s) have been attached to this email.</p>
    <p>You can also <a href="{{ route('order.tickets', $order->id) }}">view and download them online</a>.</p>
    <p>Enjoy the event!<br>— The Events Team</p>
</body>

</html>