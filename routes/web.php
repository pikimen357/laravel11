<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "<h1>Halo Dunia</h1>";
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
    'as' => 'movie.'
    ], function () use ($movies) {

        Route::get('/',
                    [\App\Http\Controllers\MovieController::class, 'index']
        );

        Route::post('/',
                    [\App\Http\Controllers\MovieController::class, 'store']
                    );

        Route::get('/{id}',
                    [\App\Http\Controllers\MovieController::class, 'show']);

        Route::put('/{id}', [
            \App\Http\Controllers\MovieController::class, 'update'
        ]);

        Route::patch('/{id}',
                    [\App\Http\Controllers\MovieController::class, 'partial_update']
        );

        Route::delete('/{id}',[
            \App\Http\Controllers\MovieController::class, 'destroy'
        ]);

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
            );


