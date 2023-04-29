<?php

namespace App\Repositories;

use App\Exceptions\DatabaseException;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    /**
     * @throws DatabaseException
     */
    public function create(array $attributes): Model
    {
        $attributes['user_id'] = auth()->user()->id;

        return parent::create($attributes);
    }
}
