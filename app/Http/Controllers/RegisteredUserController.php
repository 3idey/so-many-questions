<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        //     $employerAttributes = $request->validate([
        //    'employer' => ['required'],
        //    ]);
        $user = User::create($userAttributes);



        //    $user->employer()->create([
        //     'name'=> $employerAttributes['employer'],
        //    ]);

        Auth::login($user);
        return redirect('/');
    }
    public function show()
    {
        return view('auth.profile');
    }
    public function update(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::id()],
            'password' => ['sometimes', 'confirmed', Password::min(6)],
        ]);

        if (empty($userAttributes['password'])) {
            unset($userAttributes['password']);
        }

        Auth::user()->update($userAttributes);

        return back()->with('success', 'Profile updated successfully.');
    }
    public function destroy()
    {
        Auth::user()->delete();
        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
