<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile', [
            'title' => 'Profile',
            'user' => Auth::user(),
        ]);
    }

    public function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[0-9!@#$%^&*])/'],
        ], [
            'username.unique' => "This username already used",
            'username.min' => "Username min 3 character",
            'password.regex' => 'Must be including 1 uppercase, camelcase, number, and special char'
        ]);

        if ($validated->fails()) {
            return back()
                ->withErrors($validated)
                ->withInput();
        }

        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return redirect('/login')->with('success', 'Create account success, login now');
    }

    public function update(Request $request)
    {
        $role = [   
            'password' => ['required', 'min:8', 'regex:/^(?=.*[0-9!@#$%^&*])/'],
            'image' => ['image', 'file', 'max:2048'],
        ];

        $user = Auth::user();

        if($user->username !== $request->username){
            $role['username'] = ['required', 'email:dns', 'unique:users'];
        }elseif($user->email !== $request->email){
            $role['email'] = ['required', 'min:3', 'max:255', 'unique:users'];
        }

        $validated = $request->validate($role);

        if($request->file('image')){
            if($user->image){
                Storage::delete($user->image);
            }
            $validated['image'] = $request->file('image')->store('image-post');
        }

        User::find($user->id)->update($validated);

        return back()->with('success', 'Update profile success !');

    }
}
