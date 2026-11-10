<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Laravel\Telescope\TelescopeServiceProvider as LaravelTelescopeServiceProvider;

/*
|--------------------------------------------------------------------------
| Service Registration
|--------------------------------------------------------------------------
*/

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind CrawlerDetect as a singleton to share compiled regexes across requests
        $this->app->singleton(CrawlerDetect::class);

        // LaravelTelescopeServiceProvider bootstraps TelescopeServiceProvider in non-production environments
        if ($this->app->isProduction()) {
            return;
        }
        foreach ([LaravelTelescopeServiceProvider::class, TelescopeServiceProvider::class] as $provider) {
            if (class_exists($provider)) {
                $this->app->register($provider);
            }
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bootstrap pagination
        // https://laravel.com/framework/docs/pagination#using-bootstrap
        Paginator::useBootstrapFive();

        // Strict mode catches lazy loading, discarded attributes, and missing attributes early.
        Model::shouldBeStrict(! $this->app->isProduction());
    }
}
