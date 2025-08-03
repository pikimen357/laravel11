<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function index(/*$id*/){

//        $movie = Movie::find($id)->ratings()->get();

//        $movie = Movie::find($id)->with('ratings')->first();

        // if the movie has a rating
//        $movie = Movie::whereHas('ratings', function ($query) {
//            //
//            $query->select(DB::raw('AVG(rating) as rating'))->havingRaw('AVG(rating) > 3');
//        })->with('ratings')->get();

        $movie = Movie::with('ratings')->get()->filter(function ($movie) {
            return $movie->ratings->avg('rating') > 3;
        })->map(function ($movie) {
                    return [
                      'movie title' => $movie->title,
                      'average rating' => $movie->ratings->avg('rating')
                    ];
                })->values();

        return $movie;
    }

    public function store(Request $request){
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
            'rating' => 'required|numeric|between:1,5',
        ]);

        $rating = Rating::create($validated);

        return response()->json([
            'message' => 'Rating created successfully',
            'data' => $rating,
        ], 201);
    }

    public function getByMovie($movie_id){
//        $ratings = Rating::where('movie_id', $movie_id)->get();
        $movie = Movie::with('ratings')->findOrFail($movie_id);

        return response()->json([
            'id film' => $movie->id,
            'Judul Film' => $movie->title,
            'rating' => $movie->ratings,
        ]);
    }
}
