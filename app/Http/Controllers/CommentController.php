<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Repositories\CommentRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class CommentController extends ModelController
{
    public function __construct(CommentRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $comment = $this->repository->create($validated);

        return redirect()->route('site-books.show', $comment->book->slug)->with('success', 'Comment successfully added');
    }
}
