<?php

namespace App\Providers;

use App\Services\ConditionEvaluator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ConditionEvaluator::class, function ($app) {
            return new ConditionEvaluator();
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
