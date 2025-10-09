<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->string('status')->default('pending');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10)->default('RWF');
            $table->string('payment_method')->nullable();
            $table->string('processor_response')->nullable();
            $table->json('meta')->nullable(); // store full Flutterwave response if needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
