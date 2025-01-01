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

// Show => displaying ONE job
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
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
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update: Handle the form submission to update the job
Route::patch('/jobs/{id}', function ($id) {
    // 1- Validate the request
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    // Authorize...

    // 2- Update the job
    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});

// Delete: Handle the request to delete a job
Route::delete('/jobs/{id}', function ($id) {
    // Authorize...

    Job::findOrFail($id)->delete();

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});

