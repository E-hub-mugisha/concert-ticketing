<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalEvents = Event::count();
        $totalTickets = Ticket::sum('sold');
        $totalOrders = Order::count();
        $recentOrders = Order::with('items.ticket')->latest()->take(5)->get();

        // Pie chart: tickets sold per event
        $ticketsPerEvent = Event::with('tickets')->get()->map(function($event){
            return [
                'name' => $event->title,
                'sold' => $event->tickets->sum('sold')
            ];
        });

        // Line chart: daily orders last 7 days
        $dailyOrders = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'totalTickets',
            'totalOrders',
            'recentOrders',
            'ticketsPerEvent',
            'dailyOrders'
        ));
    }
}
