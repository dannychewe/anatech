<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Footer;



class ViewServiceProvider extends ServiceProvider
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
        // Share footer data globally
        View::composer('*', function ($view) {
            $footer = Footer::first(); // Fetch the first footer entry
            $view->with('globalFooter', $footer);
        });
    }
}
