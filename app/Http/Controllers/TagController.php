<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $tag->load(['questions' => function ($q) {
            $q->with('user', 'tags')
                ->withCount('answers')
                ->latest();
        }]);

        $questions = $tag->questions()
            ->with('user', 'tags')
            ->withCount('answers')
            ->latest()
            ->paginate(10);

        return view('tags.show', compact('tag', 'questions'));
    }
}
