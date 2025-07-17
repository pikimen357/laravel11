<?php

namespace App\Providers;

use App\Views\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
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
//        $config = [
//            'title' => 'Config Service Provider',
//            'year' => 2020,
//            'author' => 'Laravel',
//            'theme' => 'dark',
//            'description' => 'This is a config service provider',
//        ];

//        View::share('config', $config);

//        View::composer(['movies.index', 'movies.show', 'home'], function ($view) {
//            $view->with('menu', [
//                'Home' => '/',
//                'About' => '/about',
//                'Contact' => '/contact',
//            ]);
//        });

        View::composer(['*'], MenuComposer::class);
    }
}
