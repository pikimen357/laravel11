<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MovieController extends Controller implements HasMiddleware
{
    private $movies = [];

    public function __construct(){

        $this->movies = [
                [
                    'title' => 'Interstellar',
                    'description' => 'A mission through a wormhole to save humanity.',
                    'release_date' => '2014-11-07',
                    'cast' => ['Matthew McConaughey', 'Anne Hathaway'],
                    'genres' => ['Sci-Fi', 'Drama'],
                    'image' => 'https://image.tmdb.org/t/p/w500/rAiYTfKGqDCRIIqo664sY9XZIvQ.jpg',
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
                    'title' => 'The Prestige',
                    'description' => 'Two magicians compete in a deadly rivalry.',
                    'release_date' => '2006-10-20',
                    'cast' => ['Hugh Jackman', 'Christian Bale'],
                    'genres' => ['Drama', 'Mystery'],
                    'image' => 'https://image.tmdb.org/t/p/w500/5MXyQfz8xUP3dIFPTubhTsbFY6N.jpg',
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
                    'title' => 'Gravity',
                    'description' => 'Two astronauts are stranded in space after an accident.',
                    'release_date' => '2013-10-04',
                    'cast' => ['Sandra Bullock', 'George Clooney'],
                    'genres' => ['Drama', 'Sci-Fi'],
                    'image' => 'https://image.tmdb.org/t/p/w500/uPxtxhB2Fy9ihVqtBtNGHmknJqV.jpg',
                ],
                [
                    'title' => 'The Martian',
                    'description' => 'An astronaut is left behind on Mars.',
                    'release_date' => '2015-10-02',
                    'cast' => ['Matt Damon'],
                    'genres' => ['Adventure', 'Sci-Fi'],
                    'image' => 'https://image.tmdb.org/t/p/w500/5aGhaIHYuQbqlHWvWYqMCnj40y2.jpg',
                ],
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

    public function store(Request $request)
    {
//        $request->merge(['votes' => 0]); // modifikasi isi request
//
//        $this->movies[] = [
//            'title' => $request->get('title'),
//            'year' => $request->get('year'),
//            'rating' => $request->get('rating'),
//            'votes' => $request->get('votes') // ← ambil dari request
//        ];

        $newMovie = [
            'title' => $request['title'],
            'description' => $request['description'],
            'release_date' => $request['release_date'],
            'cast' => explode(',', $request['cast']),       // array ['Matt Damon']
            'genres' => explode(',', $request['genres']),   // array ['Adventure', 'Sci-Fi']
            'image' => $request['image'],
        ];

        $this->movies[] = $newMovie;

        return $this->index();
    }

    public function edit($id){

        $movie = $this->movies[$id];

        $movie['cast'] = implode(',', $movie['cast']);
        $movie['genres'] = implode(',', $movie['genres']);

        return view('movies.edit', ['movie' => $movie, 'movieId' => $id]);
    }


    public function update(Request $request, $id){

        $this->movies[$id]['title'] = $request['title'];
        $this->movies[$id]['description'] = $request['description'];
        $this->movies[$id]['release_date'] = $request['release_date'];
        $this->movies[$id]['cast'] = explode(',', $request['cast']);
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
