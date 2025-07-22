<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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
        // sharing public view
//        View::share('menu',[
//            'Home' => '/',
//            'About' => '/about',
//            'Contact' => '/contact',
//        ]);
        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');
    }
}
