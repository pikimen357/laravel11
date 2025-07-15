<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function mapUpper(Request $request){
        $filtered = $request->collect()->map(function ($value) {
            return strtoupper($value);
        });
        return $filtered;
    }

    public function input(Request $request){
        $input = $request->input();
        return $input;
    }

    public function inputDate(Request $request){
        if($request->has('schedule')){
            $date = $request->date('schedule', 'Y-m-d', "Asia/Jakarta");
                    // ->addDays(2);
            return $date->diffForHumans();
        }
        return "schedule not found";
    }

    public function login(Request $request){
        if($request->hasAny(['username', 'password'])){
            return "login success";
        }
        return "login failed";
    }

    public function missEmail(Request $request){

//        $request->merge(['email' => 'admin@gmail.com']);
        $request->mergeIfMissing(['email' => 'admin@gmail.com']);

        if($request->missing('email')){
            return "email not found";
        }
        return $request->email;
    }
}
