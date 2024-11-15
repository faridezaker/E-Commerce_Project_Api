<?php

namespace App\Providers;

use App\Models\Role;
use App\Observers\RoleObserver;
use Illuminate\Support\ServiceProvider;

class ModelObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Role::observe(RoleObserver::class);
    }
}
