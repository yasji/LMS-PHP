<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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

        #Define all my gates here 

        //Books
        Gate::define('manage-books', function (User $user) {
            Log::info('manage-books gate called', ['user_id' => $user->id]);
            return in_array($user->role, ['Admin']);
        });

        Gate::define('delete-books', function (User $user) {
            return $user->role === 'Admin';
        });

        //Categories
        Gate::define('manage-categories', function (User $user) {
            return in_array($user->role, ['Admin']);
        });

        Gate::define('delete-categories', function (User $user) {
            return $user->role === 'Admin';
        });

        //loans
        Gate::define('view-loans', function (User $user) {
            return in_array($user->role, ['Admin']);
        });

        Gate::define('manage-loans', function (User $user) {
            return in_array($user->role, ['Admin']);
        });

        Gate::define('delete-loans', function (User $user) {
            return $user->role === 'Admin';
        });

        //Record
        Gate::define('borrow-books', function (User $user) {
            return $user->role === 'Borrower';
        });

        Gate::define('return-books', function (User $user) {
            return $user->role === 'Borrower';
        });

        // Authors
        Gate::define('manage-authors', function (User $user) {
            return in_array($user->role, ['Admin']);
        });

        Gate::define('delete-authors', function (User $user) {
            return $user->role === 'Admin';
        });

        //Users
        Gate::define('view-users', function (User $user) {
            return $user->role === 'Admin';
        });

        Gate::define('manage-users', function (User $user) {
            return $user->role === 'Admin';
        });

        Gate::define('delete-users', function (User $user) {
            return $user->role === 'Admin';
        });

    }
}
