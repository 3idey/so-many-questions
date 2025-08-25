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

        $user = User::create($userAttributes);


        Auth::login($user);
        return redirect('/');
    }
    public function show()
    {
        $user = Auth::user();

        $questionCount = $user->questions()->count();
        $answerCount = $user->answers()->count();
        $commentCount = $user->comments()->count();

        $questions = $user->questions()
            ->with('tags')
            ->withCount('answers')
            ->latest()
            ->paginate(5, ['*'], 'questions_page');

        $answers = $user->answers()
            ->with(['question:id,title', 'question.tags'])
            ->latest()
            ->paginate(5, ['*'], 'answers_page');

        $comments = $user->comments()
            ->with(['answer:id,question_id', 'answer.question:id,title'])
            ->latest()
            ->paginate(5, ['*'], 'comments_page');

        return view('auth.profile', compact('questions', 'answers', 'comments', 'questionCount', 'answerCount', 'commentCount'));
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::id()],
            'password' => ['nullable', 'confirmed', Password::min(6)],
        ]);

        // Remove password if not provided
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        // Do not persist current_password
        unset($validated['current_password']);

        Auth::user()->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
