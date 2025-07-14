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
            'year' => "2022",
            'genre' => 'Action'
        ];
}

Route::get('/movie', function () use ($movies) {
    return $movies;
});

Route::post('/movie', function () use ($movies){
    $movies[] = [
        'title' => request('title'),
        'year' => request('year'),
        'genre' => request('genre')
    ];

    return $movies;
});

Route::put('/movie/{id}', function ($id) use ($movies){
    $movies[$id-1]['title'] = request('title');
    $movies[$id-1]['year'] = request('year');
    $movies[$id-1]['genre'] = request('genre');

    return $movies;
});

Route::patch('/movie/{id}', function ($id) use ($movies){
    $movies[$id-1]['title'] = request('title');
    $movies[$id-1]['year'] = request('year');

    return $movies;
});

Route::delete('/movie/{id}', function ($id) use ($movies){
    unset($movies[$id-1]);

    return $movies;
});

