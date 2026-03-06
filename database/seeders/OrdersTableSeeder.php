<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Artist;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $artists = Artist::all();

        if ($users->isEmpty() || $artists->isEmpty()) {
            $this->command->info('No users or artists found to create orders.');
            return;
        }

        $statuses = ['Active', 'Sent', 'Received'];

        $users->each(function ($user) use ($artists, $statuses) {
            $availableArtists = $artists->filter(fn ($a) => $a->idUser !== $user->idUser);

            if ($availableArtists->isEmpty()) {
                return;
            }

            for ($i = 0; $i < 2; $i++) {
                $artist = $availableArtists->random();

                Order::create([
                    'idUser' => $user->idUser,
                    'idArtist' => $artist->idArtist,
                    'order_status' => $statuses[array_rand($statuses)],
                    'order_details' => 'Order placed via marketplace',
                ]);
            }
        });

        $this->command->info('Seeded orders successfully.');
    }
}
