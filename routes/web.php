<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [TicketController::class, 'welcome'])->name('home');

// Tickets
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index'); // list all tickets/events
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show'); // show single ticket

// Checkout + Payment
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/payment/callback', [CheckoutController::class, 'callback'])->name('payment.callback');

// Order Status
Route::get('/order/{order}/summary', [CheckoutController::class, 'summary'])->name('order.summary');
Route::get('/order/success/{id}', [CheckoutController::class, 'success'])->name('order.success');
Route::get('/order/failed/{id}', [CheckoutController::class, 'failed'])->name('order.failed');

Route::get('/payment/callback/{order}', [CheckoutController::class, 'paymentCallback'])->name('payment.callback');

Route::get('/concert/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

Route::get('/orders/{id}/tickets', [TicketController::class, 'showticket'])->name('order.tickets');
Route::get('/tickets/{id}/download', [TicketController::class, 'downloadTicket'])->name('tickets.download');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Optional: routes to manage events, tickets, orders
    Route::resource('events', EventController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('orders', OrderController::class);
    Route::view('/users', 'admin.users.index')->name('users.index');
    Route::view('/reports', 'admin.reports.index')->name('reports.index');
    Route::view('/settings', 'admin.settings')->name('settings');

    Route::get('orders/{order}/receipt', [OrderController::class, 'receipt'])
        ->name('orders.receipt');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');

    Route::get('/tickets/{order}', [TicketController::class, 'showOrderTickets'])->name('tickets.show');
    Route::get('/tickets/{item}/download', [TicketController::class, 'downloadTicket'])->name('tickets.download');
    Route::post('/tickets/{item}/email', [TicketController::class, 'sendTicketEmail'])->name('tickets.email');
});

require __DIR__ . '/auth.php';
