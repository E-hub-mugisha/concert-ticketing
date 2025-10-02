<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Summer Music Festival',
                'description' => 'Join us for an unforgettable summer music festival with top artists.',
                'venue' => ' Kigali Arena',
                'event_date' => Carbon::now()->addDays(10),
                'capacity' => 500,
                'image' => 'events/summer_music.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jazz Night',
                'description' => 'An evening of smooth jazz with local and international musicians.',
                'venue' => 'Golden Tulip Hotel',
                'event_date' => Carbon::now()->addDays(20),
                'capacity' => 300,
                'image' => 'events/jazz_night.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rock Concert',
                'description' => 'Feel the energy of rock music live with top bands.',
                'venue' => 'Amahoro Stadium',
                'event_date' => Carbon::now()->addDays(30),
                'capacity' => 1000,
                'image' => 'events/rock_concert.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Classical Evening',
                'description' => 'A night of classical masterpieces performed by renowned orchestras.',
                'venue' => 'Kigali Convention Centre',
                'event_date' => Carbon::now()->addDays(15),
                'capacity' => 200,
                'image' => 'events/classical_evening.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'EDM Dance Party',
                'description' => 'Dance all night to the best EDM DJs in the city.',
                'venue' => 'Upbeat Club',
                'event_date' => Carbon::now()->addDays(25),
                'capacity' => 400,
                'image' => 'events/edm_party.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('events')->insert($events);
    }
}
