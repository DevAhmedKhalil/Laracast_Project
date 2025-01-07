<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    /**
     * Determine if the given job can be updated by the user.
     */
    public function edit(User $user, Job $job): bool
    {
        // Only the employer who created the job can edit it
        return $job->employer->user_id === $user->id;
    }

    /**
     * Determine if the given job can be updated by the user.
     */
    public function update(User $user, Job $job): bool
    {
        // Only the employer who created the job can update it
        return $job->employer->user_id === $user->id;
    }

    /**
     * Determine if the given job can be deleted by the user.
     */
    public function delete(User $user, Job $job): bool
    {
        // Only the employer who created the job can delete it
        return $job->employer->user_id === $user->id;
    }
}
