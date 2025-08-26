<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'body' => ['required'],
        ]);

        $question->answers()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back();
    }
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return back();
    }

    public function markBest(Question $question, Answer $answer, Request $request)
    {
        if ($request->user()->id !== $question->user_id) {
            abort(403);
        }
        $question->answers()->update(['is_best' => false]);
        $answer->update(['is_best' => true]);
        return back();
    }
}
