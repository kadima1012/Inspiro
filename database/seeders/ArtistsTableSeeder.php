<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersWithRoles = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'editor', 'artist']);
        })->get();

        foreach ($usersWithRoles as $user) {
            Artist::createForUser($user);
        }
    }
}
