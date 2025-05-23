<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TopsisService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TopsisService::class, function ($app) {
            return new TopsisService();
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
