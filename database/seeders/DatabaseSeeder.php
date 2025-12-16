<?php

namespace Database\Seeders;

use App\Models\ArtworkType;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed the roles and permissions
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            RoleHasPermissionsTableSeeder::class,
            UsersTableSeeder::class,
            ArtistsTableSeeder::class,
            CountryTableSeeder::class, 
            CityTableSeeder::class,
            LivesTableSeeder::class,
            OrdersTableSeeder::class,
            ArtworkTypeTableSeeder::class,
            ArtworkTableSeeder::class,
            ShopListTableSeeder::class,
            OrderArtworkTableSeeder::class,
            EventsTableSeeder::class,
            EventParticipationTableSeeder::class,


        ]);
    }
}