<?php

namespace App\Providers;

use App\View\Components\Alert;
use App\View\Components\Pagination;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // URL::forceScheme(scheme:'https');
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        Blade::component('alert', Alert::class);
        Blade::component('pagination', Pagination::class);
    }
}
