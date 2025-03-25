<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert a single user
        User::create
        (
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin1234'), // Ensure password is hashed
            ]
        );

        // You can also create multiple users using a loop or factory
        // Example for multiple users:
        // User::factory(10)->create(); // This will create 10 users using the factory
    }
}
