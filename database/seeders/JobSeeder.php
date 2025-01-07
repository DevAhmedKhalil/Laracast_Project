<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all user IDs
        $userIds = User::pluck('id')->toArray();

        // If no users exist, create a default user
        if (empty($userIds)) {
            $user = User::factory()->create([
                'first_name' => 'Default',
                'last_name' => 'User',
                'email' => 'default@example.com',
            ]);
            $userIds = [$user->id];
        }

        // Create 100 jobs and associate them with random users
        Job::factory(100)->create([
            'user_id' => function () use ($userIds) {
                return $userIds[array_rand($userIds)];
            },
        ]);
    }
}
