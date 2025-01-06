<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(5);

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // Create job
        $job = Job::create([
            'title' => $validatedData['title'],
            'salary' => $validatedData['salary'],
            'employer_id' => 1,  // Assuming employer_id is fixed for now
        ]);

        //* laravel will grab email address
        Mail::to($job->employer->user)->queue(
            new  JobPosted($job)
        );

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        // 1- To edit job -> you need to sign in first
        // 2- You must be responsible for this job
//        Gate::authorize('edit-job', $job);

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        Gate::authorize('edit-job', $job);

        // Validation
        $validatedData = $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // Update job
        $job->update([
            'title' => $validatedData['title'],
            'salary' => $validatedData['salary'],
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        Gate::authorize('edit-job', $job);

        // Delete the job
        $job->delete();

        return redirect('/jobs');
    }
}
