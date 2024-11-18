<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create regular user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'), // Added password
            'usertype' => 'user',  // Explicitly set usertype
            'remember_token' => Str::random(10), // Optional but recommended
        ]);

        // Create admin user
        User::factory()->create([
            'name' => 'Admin1',
            'email' => 'admin@example.com',
            'password' => bcrypt('test123'),
            'usertype' => 'admin',
            'remember_token' => Str::random(10), // Optional but recommended
        ]);

        // Optionally create additional test users
        // User::factory(10)->create(); // Creates 10 random users
    }
}
