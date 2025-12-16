<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lives;
use App\Models\User;
use App\Models\City;

class LivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $users = User::all();
        $cities = City::all();

        if ($users->isEmpty() || $cities->isEmpty()) {
            $this->command->info('Nu există suficienți utilizatori sau orașe pentru a popula tabela "lives".');
            return;
        }

        $users->each(function ($user) use ($cities) {
            $city = $cities->random();

            Lives::create([
                'idUser' => $user->idUser,
                'idCity' => $city->idCity,
            ]);
        });

        $this->command->info('Seeder for the "lives" table has been run successfully!');

    }
}
