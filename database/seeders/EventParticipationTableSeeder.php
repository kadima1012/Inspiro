<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;

class EventParticipationTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $events = Event::all();

        if ($users->isEmpty() || $events->isEmpty()) {
            $this->command->info('No users or events found for participation seeding.');
            return;
        }

        $statuses = ['Visiting', 'Exhibiting'];

        foreach ($events as $event) {
            // Add 3-6 random participants per event
            $participants = $users->random(min($users->count(), rand(3, 6)));

            foreach ($participants as $user) {
                DB::table('event_participation')->insert([
                    'idUser' => $user->idUser,
                    'IdEvents' => $event->IdEvents,
                    'participation_status' => $statuses[array_rand($statuses)],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        $this->command->info('Seeded event participations successfully.');
    }
}
