<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Validator;

class AuthenticateController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()
            ->with('failed', 'Your username and password wrong')
            ->withInput();
    }

    public function register()
    {
        return view('register', [
            'title' => 'Register'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
