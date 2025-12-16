<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'event_name' => 'Spring Art Exhibition',
                'event_description' => 'An exhibition showcasing the latest works of contemporary artists.',
                'event_date' => Carbon::create('2024', '05', '20'),
                'event_location' => 'New York Art Gallery, NY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_name' => 'Summer Art Market',
                'event_description' => 'A market event where artists display and sell their summer-themed artworks.',
                'event_date' => Carbon::create('2024', '07', '10'),
                'event_location' => 'Central Park, NY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_name' => 'Autumn Artist Fair',
                'event_description' => 'A fair for artists to present and sell their autumn-inspired creations.',
                'event_date' => Carbon::create('2024', '10', '05'),
                'event_location' => 'Golden Gate Park, CA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
