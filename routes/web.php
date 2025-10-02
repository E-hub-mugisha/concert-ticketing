<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [TicketController::class, 'welcome'])->name('welcome');

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
