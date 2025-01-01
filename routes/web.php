<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

// Home route
Route::get('/', function () {
    return view('home');
});

// Index => displaying all jobs
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        "jobs" => $jobs
    ]);
});

// Create Job
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show => GET specific job => use Route Model Binding
Route::get('/jobs/{job}', function (Job $job) {
    return view('jobs.show', ['job' => $job]);
});

// Store job in DB
Route::post('/jobs', function () {
    //1- validation ...
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    //2- create job
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});

// Edit job
Route::get('/jobs/{job}/edit', function (Job $job) {
    return view('jobs.edit', ['job' => $job]);
});

// Update: Handle the form submission to update the job
Route::patch('/jobs/{job}', function (Job $job) {
    // Authorize...

    // 1- Validate the request
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    // 2- Update the job
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});

// Delete: Handle the request to delete a job
Route::delete('/jobs/{job}', function (Job $job) {
    // Authorize...

    $job->delete();

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});

