<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createProfile(Request $request, $id){

//        $id = $request->id;
        $user = User::find($id);

        $user->profile()->create([
            'phone' => '0813547892',
            'address' => 'Jl. Pakisbaru Kismantoro'
        ]);

        return $user;
    }

    public  function getProfile(Request $request, $id){

        $user = User::find($id);


        // lazy loading (n+1 problem)
//        return $user->profile;

        //eager loading manual
//        return $user->load('profile');

        //automatic eager loading (User.php -> protected $with = ['profile'];)
        return $user;
    }

    public function  updateProfile(Request $request, $id)
    {
        $user = User::find($id);

        $user->profile->update([
            'phone' => '082999998',
            'address' => 'Jl. Antah Brantah'
        ]);

        return $user;
    }

    public function deleteProfile(Request $request, $id){
        $user = User::find($id);

        $user->profile()->delete();

        return $user;
    }
}
