<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

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
}


Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    return view('jobs', [
        "jobs" => Job::all()
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $jobs = Job::all();

    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);
//    dd($job);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
