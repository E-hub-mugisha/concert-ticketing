@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container py-5">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Events</h5>
                    <p class="card-text">{{ $totalEvents }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tickets Sold</h5>
                    <p class="card-text">{{ $totalTickets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <h4>Tickets Sold Per Event</h4>
            <canvas id="pieChart"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Daily Orders (Last 7 Days)</h4>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <h3>Recent Orders</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Tickets</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>${{ number_format($order->total_amount,2) }}</td>
                <td>{{ ucfirst($order->payment_status) }}</td>
                <td>
                    @foreach($order->items as $item)
                        {{ $item->attendee_name }} ({{ $item->ticket->name }}) <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart - Tickets Sold per Event
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: @json($ticketsPerEvent->pluck('name')),
            datasets: [{
                label: 'Tickets Sold',
                data: @json($ticketsPerEvent->pluck('sold')),
                backgroundColor: [
                    '#0d6efd', '#198754', '#ffc107', '#dc3545', '#6c757d'
                ],
            }]
        }
    });

    // Line Chart - Daily Orders
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: @json($dailyOrders->pluck('date')),
            datasets: [{
                label: 'Orders',
                data: @json($dailyOrders->pluck('count')),
                fill: false,
                borderColor: '#0d6efd',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
@endsection
