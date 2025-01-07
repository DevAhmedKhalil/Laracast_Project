<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

// General routes
Route::view('/', 'home');
Route::view('/contact', 'contact');

// Employer registration routes
Route::middleware('auth')->group(function () {
    Route::get('/employer/register', [EmployerController::class, 'create'])->name('employer.create');
    Route::post('/employer/register', [EmployerController::class, 'store'])->name('employer.store');
});

// Public job routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'createJob'])->name('jobs.create')->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store')->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Authenticated job routes
Route::middleware('auth')->group(function () {
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
        ->name('jobs.edit')
        ->can('edit', 'job');

    Route::patch('/jobs/{job}', [JobController::class, 'update'])
        ->name('jobs.update')
        ->can('edit', 'job');

    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
        ->name('jobs.destroy')
        ->can('edit', 'job');
});

// Auth routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

