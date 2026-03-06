<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lives;
use App\Models\User;
use App\Models\City;

class LivesTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $cities = City::all();

        if ($users->isEmpty() || $cities->isEmpty()) {
            $this->command->info('No users or cities found to populate the "lives" table.');
            return;
        }

        $users->each(function ($user) use ($cities) {
            Lives::create([
                'idUser' => $user->idUser,
                'idCity' => $cities->random()->idCity,
            ]);
        });

        $this->command->info('Seeded user locations successfully.');
    }
}
