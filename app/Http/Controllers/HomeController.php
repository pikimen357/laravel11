<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
//        $auth= $request->authenticated;
//        return $auth;
//        $name = 'Laravel';

        $movies = [
            ["title" => "The Last Knight",  "year" => 2019],
            ["title" => "Owl",  "year" => 2007],
            ["title" => "Barbie",  "year" => 2011],
            ["title" => "Joker",  "year" => 2019],
            ["title" => "The Godfather",  "year" => 1972],
            ["title" => "Boys",  "year" => 1988],
        ];

        $user = [
            'name' => 'Rizky',
            'email' => 'rizk@gmail.com',
            'is_admin' => true
        ];

        $movieCategory = 'blabla';
        return view('home', compact( 'movieCategory', 'user', 'movies'));
    }
}
