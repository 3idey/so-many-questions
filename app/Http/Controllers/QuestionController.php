<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('user', 'tags')->latest()->get();
        return view('Home', compact('questions'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('questions.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'body' => ['required'],
            'tags' => ['array'],
        ]);

        $question = Auth::user()->questions()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $question->tags()->sync($request->tags);

        return redirect()->route('questions.index');
    }

    public function show(Question $question)
    {
        $question->load('answers.user', 'tags');
        return view('questions.show', compact('question'));
    }
}
