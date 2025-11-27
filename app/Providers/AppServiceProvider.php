<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\Announcement;
use App\Models\User;

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
        Paginator::defaultView('pagination::default');

        Gate::define('destroy-announcement', function (User $user, Announcement $announcement) {
            return $user->role === 'admin'
                || $user->id === $announcement->owner_id;
        });
        Gate::define('update-announcement', function (User $user, Announcement $announcement) {
            return $user->id === $announcement->owner_id;
        });
    }
}
