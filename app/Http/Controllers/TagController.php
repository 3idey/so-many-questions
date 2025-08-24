<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $tag->load(['questions' => function ($q) {
            $q->with('user', 'tags')
              ->withCount('answers')
              ->latest();
        }]);

        // Manually paginate the related questions collection using query for performance
        $questions = $tag->questions()
            ->with('user', 'tags')
            ->withCount('answers')
            ->latest()
            ->paginate(10);

        return view('tags.show', compact('tag', 'questions'));
    }
}
