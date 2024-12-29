<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job
{
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '%50,000'
            ],
            [
                'id' => 2,
                'title' => 'Developer',
                'salary' => '%30,000'],
            [
                'id' => 3,
                'title' => 'Designer',
                'salary' => '%20,000'
            ]];
    }

    public static function find(int $id): array # this will help in Error
    {
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);

        if (!$job) {
            abort(404);
        }

        return $job;
    }
}
