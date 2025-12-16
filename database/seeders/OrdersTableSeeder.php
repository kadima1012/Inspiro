<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all users
        $users = User::all();

        // Check if there are users
        if ($users->isEmpty()) {
            $this->command->info('No users found to create orders.');
            return;
        }

        $this->command->info('Seeder for the "orders" table has been run successfully!');
    }
}
