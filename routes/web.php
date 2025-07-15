<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin/login', function () {
    return 'Admin Login page';
})->name('admin.login');

Route::get('admin/dashboard', function () use ($movies){

    $movies[] = [
        'title' => request('title'),
        'year' => request('year'),
        'genre' => request('genre'),
        'sold' => request('sold')
    ];

    return $movies;
})->middleware( \App\Http\Middleware\EnsureUserHasRole::class. ':admin')
    ->name('admin.dashboard');

