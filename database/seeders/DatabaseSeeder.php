<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a specific user
        User::factory()->create([
            'first_name' => 'Ahmed',
            'last_name' => 'Khalil',
            'email' => 'test@example.com',
        ]);

        // Create 10 additional users
        User::factory(10)->create();

        // Create 100 jobs and associate them with random users
        $this->call(JobSeeder::class);
    }
}
