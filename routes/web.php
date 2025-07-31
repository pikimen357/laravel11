<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {

    $movies = [
                [
                    'title' =>  'Final Destination Bloodlines', //
                    'description' => 'Plagued by a violent recurring nightmare, college student Stefanie heads home to track down the one person who might be able to break the cycle and save her family from the grisly demise that inevitably awaits them all..',
                    'release_date' => '2025-05-14',
                    'cast' => ['Richard', 'Anna', 'Owen'],
                    'genres' => ['Horror', 'Mystery'],
                    'image' => 'https://media.themoviedb.org/t/p/w600_and_h900_bestv2/bNn1WyEC8tXK2HucphV87MMLxNQ.jpg',
                ],
                [
                    'title' => 'The Dark Knight',
                    'description' => 'Batman battles the Joker in Gotham.',
                    'release_date' => '2008-07-18',
                    'cast' => ['Christian Bale', 'Heath Ledger'],
                    'genres' => ['Action', 'Crime'],
                    'image' => '', // https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg
                ],
                [
                    'title' => 'Dunkirk',
                    'description' => 'Allied soldiers are rescued during WWII.',
                    'release_date' => '2017-07-21',
                    'cast' => ['Fionn Whitehead', 'Tom Hardy'],
                    'genres' => ['War', 'Drama'],
                    'image' => 'https://image.tmdb.org/t/p/w500/ebSnODDg9lbsMIaWg2uAbjn7TO5.jpg',
                ],
                [
                    'title' => 'Tenet',
                    'description' => 'A secret agent manipulates time to prevent World War III.',
                    'release_date' => '2020-08-26',
                    'cast' => ['John David Washington', 'Robert Pattinson'],
                    'genres' => ['Action', 'Sci-Fi'],
                    'image' => 'https://image.tmdb.org/t/p/w500/k68nPLbIST6NP96JmTxmZijEvCA.jpg',
                ],
                [
                    'title' => 'Avatar',
                    'description' => 'A marine on an alien planet becomes torn between two worlds.',
                    'release_date' => '2009-12-18',
                    'cast' => ['Sam Worthington', 'Zoe Saldana'],
                    'genres' => ['Adventure', 'Sci-Fi'],
                    'image' => 'https://image.tmdb.org/t/p/w500/kyeqWdyUXW608qlYkRqosgbbJyK.jpg',
                ],
                [
                    'title' => 'Thunderbolts*',
                    'description' => 'After finding themselves ensnared in a death trap, seven disillusioned castoffs must embark on a dangerous mission that will force them to confront the darkest corners of their pasts.',
                    'release_date' => '2025-05-02',
                    'cast' => [
                        'Florence Pugh',
                        'Sebastian Stan',
                        'Julia Louis‑Dreyfus',
                    ],
                    'genres' => ['Action', 'Science Fiction', 'Adventure'],
                    'image' => 'https://media.themoviedb.org/t/p/w600_and_h900_bestv2/hqcexYHbiTBfDIdDWxrxPtVndBX.jpg'
                ],
                [
                        'title' => 'Kaiju No. 8: Mission Recon',
                        'description' => 'In a Kaiju-filled Japan, Kafka Hibino works in monster disposal. After reuniting with his childhood friend Mina Ashiro, a rising star in the anti-Kaiju Defense Force, he decides to pursue his abandoned dream of joining the Force, when he suddenly transforms into the powerful "Kaiju No. 8." Includes an action-packed recap of the first season and a new original episode, Hoshina\'s Day Off.',
                        'release_date' => '2025-04-13',
                        'cast' => [ 'Masaya Fukunishi', 'Wataru Katoh', 'Fairouz Ai'],
                        'genres' => ['Animation', 'Action', 'Science Fiction'], // :contentReference[oaicite:4]{index=4}
                        'image' => 'https://media.themoviedb.org/t/p/w600_and_h900_bestv2/1aEfyTWUK8ZBk4aw7Ck0qEoF8PW.jpg',
                ]
        ];

    return view('welcome', ['movies' => $movies]);
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

Route::get('storage/pictures/{filename}', [\App\Http\Controllers\FileUploadController::class, 'showPicture'])
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

Route::group(["prefix" => "/session"], function () {

    Route::get('/create', function (Request $request) {
        $request->session()->put('is_membership', 'yes');
    //    session(['is_membership' => 'yes']);
        return 'OK';
    });

    Route::get('/get', function () {
        return session('is_membership');
    });

    Route::get('/input', function (Request $request) {
        $name = $request->get('name');
        $hobbie1 = $request->get('hobby1');
        $hobbie2 = $request->get('hobby2');
        session(['name' => $name, 'hobbies' => [$hobbie1, $hobbie2] ]);
        return 'OK';
    });

    Route::get('/all', function () {
        return session()->all();
    });

    Route::get('/forget', function () {
        session()->forget('name');
        return 'OK';
    });

});

Route::group([
                "prefix" => "/categories",
                "as" => "categories.",
                "controller" => \App\Http\Controllers\CategoryController::class,
            ], function () {

        Route::get('/',  'index')->name('index');
        Route::get('/{id}',  'show')->name('show');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

});

Route::group([
                "prefix" => "/user/profile",
                "as" => "user.profile.",
                "controller" => \App\Http\Controllers\UserController::class,
            ], function () {

    Route::post('/{id}',  'createProfile')->name('create');
    Route::get('/{id}',  'getProfile')->name('get');
    Route::put('/{id}',  'updateProfile')->name('update');
    Route::delete('/{id}',  'deleteProfile')->name('delete');

});

//Route::post('/user/profile/{id}/' ,
//    [\App\Http\Controllers\UserController::class, 'createProfile'])->name('user.profile.create');


Route::get('/rating/', [\App\Http\Controllers\RatingController::class, 'index']);
Route::post('movies/{id}/categories', [\App\Http\Controllers\MovieController::class, 'attachCategory']);
Route::delete('movies/{id}/categories', [\App\Http\Controllers\MovieController::class, 'detachCategory']);

Route::get('sync-category/{id}', [\App\Http\Controllers\MovieController::class, 'syncCategory']);;

