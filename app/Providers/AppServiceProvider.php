<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Internal Server Error -> Illuminate\Database\LazyLoadingViolationException\
        // You can solve this by -> 'Eager Loading' the relationship
        Model::preventLazyLoading();

//        Gate::define('edit-job', function (User $user, Job $job) {  // User here is always Signed In
//            return ($job->employer->user->is($user));
//        });
    }
}
