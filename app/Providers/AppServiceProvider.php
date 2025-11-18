<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Footer;

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
        View::composer('*', function ($view) {
            // Cache for performance if footer changes rarely (optional)
            $globalFooter = cache()->remember('global_footer', 600, function () {
                return Footer::first();
            });

            $view->with('globalFooter', $globalFooter);
        });
    }
}
