<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

$jobs = [
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

Route::get('/jobs', function () use ($jobs) {
    return view('jobs', [
        "jobs" => [
            $jobs
        ]]);
});

Route::get('/jobs/{id}', function ($id) use ($jobs) {
    $jobs = [
        $jobs
    ];

    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);
//    dd($job);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
