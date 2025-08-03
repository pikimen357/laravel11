<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegisterForm(): View{
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse{

        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'Signup Berhasil!');
    }

    public function showLoginForm(): View{
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse{
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard')
                    ->with('success', 'Login Berhasil!');
        }

        return back()->with('error', 'Login Gagal!');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Berhasil!');
    }


}
