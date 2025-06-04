<?php

namespace App\Providers;

use Illuminate\Foundation\MaintenanceModeManager;
use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // $this->app->singleton('files', fn () => new Filesystem);
        $this->app->singleton('files', function ($app) {
            return new Filesystem;
        });
        $this->app->singleton(MaintenanceMode::class, function ($app) {
            return new MaintenanceModeManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
