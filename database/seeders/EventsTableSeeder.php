<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'event_name' => 'Spring Art Exhibition',
                'event_description' => 'An exhibition showcasing the latest works of contemporary artists. Join us for an evening of creativity, networking, and artistic discovery.',
                'event_date' => Carbon::now()->addMonths(2)->format('Y-m-d'),
                'event_location' => 'New York Art Gallery, NY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_name' => 'Summer Art Market',
                'event_description' => 'A vibrant market event where artists display and sell their summer-themed artworks. Browse unique pieces and meet the creators behind them.',
                'event_date' => Carbon::now()->addMonths(4)->format('Y-m-d'),
                'event_location' => 'Central Park, NY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_name' => 'Autumn Artist Fair',
                'event_description' => 'A fair for artists to present and sell their autumn-inspired creations. Experience live painting demonstrations and workshops.',
                'event_date' => Carbon::now()->addMonths(6)->format('Y-m-d'),
                'event_location' => 'Golden Gate Park, CA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_name' => 'Digital Art Symposium',
                'event_description' => 'Explore the intersection of technology and art. Featuring talks, installations, and interactive digital experiences from leading digital artists.',
                'event_date' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'event_location' => 'MOCA, Los Angeles, CA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_name' => 'Photography Showcase',
                'event_description' => 'A curated exhibition of photographic works spanning landscape, portrait, and abstract genres. Open to submissions from all skill levels.',
                'event_date' => Carbon::now()->addMonths(1)->format('Y-m-d'),
                'event_location' => 'The Gallery Space, London, UK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
