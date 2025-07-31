<?php

namespace App\Http\Controllers;

use App\Models\Movie;
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
        })
            ->map(function ($movie) {
                return [
                  'movie title' => $movie->title,
                  'average rating' => $movie->ratings->avg('rating')
                ];
            })->values();

        return $movie;
    }
}
