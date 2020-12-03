<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// need to import the facades schema
// solve the key was too long issues
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // solve the key was too long issues
        Schema::defaultStringLength(191);
    }
}
