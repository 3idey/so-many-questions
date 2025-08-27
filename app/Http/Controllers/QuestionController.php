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
        $questions = Question::with('user', 'tags')
            ->withCount('answers') //for display (answers_count)
            ->latest()
            ->paginate(10);
        $tags = Tag::orderBy('name')->get();
        return view('Home', compact('questions', 'tags'));
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->get();
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

        $question->tags()->sync($request->tags ?? []);

        return redirect()->route('questions.index');
    }

    public function show(Question $question)
    {
        $question->load([
            'user',
            'tags',
            'answers' => function ($q) {
                $q->with(['user', 'comments.user'])
                    ->orderByDesc('is_best')
                    ->latest();
            },
        ]);
        return view('questions.show', compact('question'));
    }
    public function destroy(Question $question, Request $request)
    {
        if ($question->user_id !== $request->user()->id) {
            abort(403);
        }
        $question->delete();
        return redirect()->route('questions.index');
    }
}
