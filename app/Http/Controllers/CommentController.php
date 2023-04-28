<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        $comment = new Comment($validated);
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->route('site-books.show', $comment->book->slug)->with('success', 'Comment successfully added');
    }
}
