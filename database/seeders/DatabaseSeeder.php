<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // 1. Roles & Permissions
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            RoleHasPermissionsTableSeeder::class,

            // 2. Users & Artists
            UsersTableSeeder::class,
            ArtistsTableSeeder::class,

            // 3. Location
            CountryTableSeeder::class,
            CityTableSeeder::class,
            LivesTableSeeder::class,

            // 4. Artwork Types & Artworks
            ArtworkTypeTableSeeder::class,
            ArtworkTableSeeder::class,

            // 5. Shop & Orders (depends on artworks)
            ShopListTableSeeder::class,
            OrdersTableSeeder::class,
            OrderArtworkTableSeeder::class,

            // 6. Events
            EventsTableSeeder::class,
            EventParticipationTableSeeder::class,

            // 7. Reviews
            ReviewTableSeeder::class,
        ]);
    }
}
