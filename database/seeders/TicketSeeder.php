<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // Assuming you have 5 events with IDs 1-5
        $tickets = [
            // Event 1
            [
                'event_id' => 1,
                'name' => 'VIP',
                'price' => 100.00,
                'quantity' => 50,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 1,
                'name' => 'Regular',
                'price' => 50.00,
                'quantity' => 200,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Event 2
            [
                'event_id' => 2,
                'name' => 'VIP',
                'price' => 120.00,
                'quantity' => 30,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 2,
                'name' => 'Regular',
                'price' => 60.00,
                'quantity' => 150,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Event 3
            [
                'event_id' => 3,
                'name' => 'VIP',
                'price' => 150.00,
                'quantity' => 40,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 3,
                'name' => 'Regular',
                'price' => 70.00,
                'quantity' => 300,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Event 4
            [
                'event_id' => 4,
                'name' => 'VIP',
                'price' => 130.00,
                'quantity' => 20,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 4,
                'name' => 'Regular',
                'price' => 65.00,
                'quantity' => 100,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Event 5
            [
                'event_id' => 5,
                'name' => 'VIP',
                'price' => 110.00,
                'quantity' => 25,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 5,
                'name' => 'Regular',
                'price' => 55.00,
                'quantity' => 120,
                'sold' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tickets')->insert($tickets);
    }
}
