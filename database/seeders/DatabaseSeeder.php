<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        # USER
        // User::factory(10)->create();
        User::factory()->create([
            'first_name' => 'Ahmed',
            'last_name' => 'Khalil',
            'email' => 'test@example.com',
        ]);

        # JOB
        // Job::factory(100)->create();
        $this->call(JobSeeder::class);
    }
}
