<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;

class MovieController extends Controller implements HasMiddleware
{
    private $movies = [];

    public function __construct(){

        $this->movies = [
                [
                    'title' => 'Final Destination Bloodlines',
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
                    'image' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg',
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

    }

    public static function middleware(){
//        return [
//                'isAuth',
//                new Middleware('isMember', only: ['show']),
////                new Middleware('isMember', except: ['destroy'])
//        ];
    }

    public function index(/*Request $request*/){
//        return response()->json([
//            'movies' => $this->movies,
//            'message' => 'success get all movies'
//        ], 200);
//        $is_admin = $request->get('is_admin', false);
        $movies = $this->movies;
//        return view('movies.index', ['movies' => $movies]);
        return view('movies.index', compact('movies'))
                ->with([
                    'titlePage' => 'List of Movies',
//                    'is_admin' => $is_admin,
                ]);
//        return view('movies.index')->with(['movies' => $movies]);
    }

    public function show($id){
//        return response()->json($this->movies[$id - 1]);
        $movie = $this->movies[$id];
//        return view('movies.show', ['movie' => $movie]);
        return view('movies.show', compact('movie'))
                ->with([
                    'titlePage' => 'Movie Detail',
                    'idMovie' => $id,
                ]);
    }

    public function create(){
        return view('movies.create');
    }

    public function store(StoreMovieRequest $request)
    {
        // Ganti dari $request->validate() ke $request->validated()
        $validatedData = $request->validated();

        $newMovie = [
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'release_date' => $validatedData['release_date'],
            'cast' => explode(',', $validatedData['cast']),
            'genres' => explode(',', $validatedData['genres']),
            'image' => $validatedData['image'],
        ];

        $this->movies[] = $newMovie;
        return $this->index();
    }

    public function edit($id){

        $movie = $this->movies[$id];

        // Combining arrays into strings with separator
        $movie['cast'] = implode(',', $movie['cast']);
        $movie['genres'] = implode(',', $movie['genres']);

        return view('movies.edit', ['movie' => $movie, 'movieId' => $id]);
    }


    public function update(Request $request, $id){

        $this->movies[$id]['title'] = $request['title'];
        $this->movies[$id]['description'] = $request['description'];
        $this->movies[$id]['release_date'] = $request['release_date'];
        $this->movies[$id]['cast'] = explode(',', $request['cast']); // string -> array
        $this->movies[$id]['genres'] = explode(',', $request['genres']);
        $this->movies[$id]['image'] = $request['image'];

        return $this->show($id);
    }

    public function partial_update(Request $request, $id){
        $this->movies[$id - 1] = [
                'title' => $request->get('title'),
                'year' => $this->movies[$id - 1]['year'], // year will not change
                'director' => $this->movies[$id - 1]['director'], // director will not change
                'rating' => $request->get('rating'),
            ];

        return $this->movies;
    }

    public function destroy($id){
        unset($this->movies[$id]);
        return $this->index();
    }

}
