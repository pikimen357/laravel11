<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('app');
});

Route::get('/home', function () {
    return view('home');
});

$movies = [];

for($i = 0; $i <= 3; $i++) {
        $movies[] = [
            'title' => 'Movie ' . $i + 1,
            'year' => $i + 2001,
            'genre' => 'Action',
            'sold' => $i + 4
        ];
}

Route::group([
    'prefix' => 'movie',
    'as' => 'movie.',
    'controller' => \App\Http\Controllers\MovieController::class,
    ], function ()  {

        Route::get('/', 'index')->name('index'); // route('movie.index')

        Route::get('/create', 'create')->name('create');

        Route::get('/{id}','show')->name('show');

        Route::post('/','store' )->name('store');

        Route::get('/{id}/edit','edit' )->name('edit');

        Route::put('/{id}', 'update')->name('update');

//        Route::patch('/{id}','partial_update');

        Route::delete('/{id}', 'destroy')->name('destroy');

});

Route::get('/pricing', function () {
    return 'Please, buy a membership';
})->name('pricing');

Route::get('/login', function () {
    return 'Login page';
})->name('login');

Route::group(["prefix" => "admin", "as" => "admin."], function () use ($movies){

    Route::get('/login', function () {
        return 'Admin Login page';
    })->name('admin.login');

    Route::get('/dashboard', function () {

        $movies[] = [
            'title' => request('title'),
            'year' => request('year'),
            'genre' => request('genre'),
            'sold' => request('sold')
        ];

        return $movies;
    })->middleware( \App\Http\Middleware\EnsureUserHasRole::class. ':admin')
        ->name('admin.dashboard');

});

Route::controller(\App\Http\Controllers\InputController::class)
        ->prefix('request')
        ->group(function () {

            Route::get('/','mapUpper');

            Route::post('/','input');

            Route::post('/date', 'inputDate');

            Route::post('/login', 'login');

            Route::post('/miss-email', 'missEmail');

        });

Route::post('/upload/picture',
            [\App\Http\Controllers\FileUploadController::class, 'upload']
            )->name('upload.picture');

Route::get('/picture/{filename}', [\App\Http\Controllers\FileUploadController::class, 'showPicture'])
    ->name('picture.show');

Route::get('/response', function () {
    return response("OK")
            ->header('Content-Type', 'text/plain');
});

Route::get('/cache-control', function () {
    return Response::make("Page allow to cache", 200)
                ->header('Cache-Control', 'public,max-age=7200');
});

Route::middleware('cache.headers:public;max_age=7200;etag')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/dashboard/login', function () {

        $user = 'admin';

        return response('login success', 200)
            ->cookie('user', $user);
    });

    Route::get('/logout', function () {

        // redirect to controller
        return redirect()->action([HomeController::class, 'index'],
                                    ['authenticated' => true]);
    });

    Route::get('/dashboard/logout', function () {
//        return response('logout success', 200)
//            ->withoutCookie('user');
        return response('logout success', 200)
            ->cookie('user', null);
    });

    Route::get('/privacy', function () {
        return 'Privacy Policy';
    });

    Route::get('/terms', function () {
        return 'Terms of Service';
    });

    Route::get('/laravel', function () {
        return redirect()->away('https://laravel.com');
    });
});


