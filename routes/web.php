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
    'middleware' => 'isAuth',
    'prefix' => 'movie',
    'as' => 'movie.'
    ], function () use ($movies) {

        Route::get('/', function () use ($movies) {
            return $movies;
        });

        Route::post('/', function () use ($movies){
            $movies[] = [
                'title' => request('title'),
                'year' => request('year'),
                'genre' => request('genre')
            ];

            return $movies;
        });

        Route::get('/{id}', function ($id) use ($movies){
            return $movies[$id-1];
        })->middleware(['isMember']);

        Route::put('/{id}', function ($id) use ($movies){
            $movies[$id-1]['title'] = request('title');
            $movies[$id-1]['year'] = request('year');
            $movies[$id-1]['genre'] = request('genre');

            return $movies;
        });

        Route::patch('/{id}', function ($id) use ($movies){
            $movies[$id-1]['title'] = request('title');
            $movies[$id-1]['year'] = request('year');

            return $movies;
        });

        Route::delete('/{id}', function ($id) use ($movies){
            unset($movies[$id-1]);

            return $movies;
        });

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

