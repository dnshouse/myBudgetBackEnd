<?php

namespace App\Providers;

use Firebase\Auth\Token\Verifier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Verifier::class, function ($app) {
            return new Verifier(config('services.firebase.project_id'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
