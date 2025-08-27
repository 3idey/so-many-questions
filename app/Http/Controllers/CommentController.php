<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Termwind\Components\Raw;

class CommentController extends Controller
{
    public function store(Request $request, Answer $answer)
    {
        $request->validate([
            'body' => ['required'],
        ]);

        $answer->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back();
    }

    public function destroy(Comment $comment, Request $request)
    {
        if ($comment->user_id !== $request->user()->id) {
            abort(403);
        }
        $comment->delete();
        return back();
    }
}
