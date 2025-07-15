<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MovieController extends Controller implements HasMiddleware
{
    public $movies;

    public function __construct(){

        for ($i = 0; $i <= 3; $i++) {
            $this->movies[] = [
                'title' => 'Movie ' . $i + 1,
                'year' => 2000 + $i + 1,
                'director' => 'Raisan',
                'rating' => 4
            ];
        }

    }

    public static function middleware(){
        return [
                'isAuth',
                new Middleware('isMember', only: ['show']),
//                new Middleware('isMember', except: ['destroy'])
        ];
    }

    public function index(){
        return response()->json($this->movies);
    }

    public function show($id){
        return response()->json($this->movies[$id - 1]);
    }

    public function store(Request $request)
    {
        $request->merge(['votes' => 0]); // modifikasi isi request

        $this->movies[] = [
            'title' => $request->get('title'),
            'year' => $request->get('year'),
            'rating' => $request->get('rating'),
            'votes' => $request->get('votes') // ← ambil dari request
        ];

        return $this->movies;
    }


    public function update(Request $request, $id){
        $this->movies[$id - 1] = [
                'title' => $request->get('title'),
                'year' => $request->get('year'),
                'rating' => $request->get('rating')
            ];

        return $this->movies;
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
        unset($this->movies[$id - 1]);
        return $this->movies;
    }

}
