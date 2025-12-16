<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['user_first_name' => 'John', 'user_last_name' => 'Doe', 'user_username' => 'john.doe', 'email' => 'john@example.com', 'status' => 1, 'user_birthdate' => '1990-05-15 00:00:00', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['user_first_name' => 'Jane', 'user_last_name' => 'Smith', 'user_username' => 'jane.smith', 'email' => 'jane@example.com', 'status' => 1, 'user_birthdate' => '1985-10-20 00:00:00', 'password' => Hash::make('password'), 'role' => 'editor'],
            ['user_first_name' => 'Emily', 'user_last_name' => 'Johnson', 'user_username' => 'emily.johnson', 'email' => 'emily@example.com', 'status' => 1, 'user_birthdate' => '1992-03-25 00:00:00', 'password' => Hash::make('password'), 'role' => 'user'],
            ['user_first_name' => 'Michael', 'user_last_name' => 'Brown', 'user_username' => 'michael.brown', 'email' => 'michael@example.com', 'status' => 1, 'user_birthdate' => '1988-07-10 00:00:00', 'password' => Hash::make('password'), 'role' => 'user'],
            ['user_first_name' => 'Sarah', 'user_last_name' => 'Davis', 'user_username' => 'sarah.davis', 'email' => 'sarah@example.com', 'status' => 1, 'user_birthdate' => '1995-02-18 00:00:00', 'password' => Hash::make('password'), 'role' => 'artist'],
            ['user_first_name' => 'James', 'user_last_name' => 'Miller', 'user_username' => 'james.miller', 'email' => 'james@example.com', 'status' => 1, 'user_birthdate' => '1987-08-05 00:00:00', 'password' => Hash::make('password'), 'role' => 'user'],
            ['user_first_name' => 'Patricia', 'user_last_name' => 'Wilson', 'user_username' => 'patricia.wilson', 'email' => 'patricia@example.com', 'status' => 1, 'user_birthdate' => '1991-11-12 00:00:00', 'password' => Hash::make('password'), 'role' => 'user'],
            ['user_first_name' => 'Robert', 'user_last_name' => 'Taylor', 'user_username' => 'robert.taylor', 'email' => 'robert@example.com', 'status' => 1, 'user_birthdate' => '1989-03-22 00:00:00', 'password' => Hash::make('password'), 'role' => 'editor'],
            ['user_first_name' => 'Linda', 'user_last_name' => 'Anderson', 'user_username' => 'linda.anderson', 'email' => 'linda@example.com', 'status' => 1, 'user_birthdate' => '1994-07-29 00:00:00', 'password' => Hash::make('password'), 'role' => 'artist'],
            ['user_first_name' => 'Charles', 'user_last_name' => 'Thomas', 'user_username' => 'charles.thomas', 'email' => 'charles@example.com', 'status' => 1, 'user_birthdate' => '1990-01-17 00:00:00', 'password' => Hash::make('password'), 'role' => 'admin'],
        ];
        
        foreach ($users as $userData) {
            $user = User::create([
                'user_first_name' => $userData['user_first_name'],
                'user_last_name' => $userData['user_last_name'],
                'user_username' => $userData['user_username'],
                'email' => $userData['email'],
                'user_status' => $userData['status'],
                'user_birthdate' => $userData['user_birthdate'],
                'password' => $userData['password'],
                'user_became_artist' => $userData['role'] !== 'user' ? true : false,
                'user_became_artist_date' => $userData['role'] !== 'user' ? Carbon::now() : null,
            ]);

            $role = Role::where('name', $userData['role'])->first();
            if ($role) {
                $user->assignRole($role);
            }
        }
    }
}
