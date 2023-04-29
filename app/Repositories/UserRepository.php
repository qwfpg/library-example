<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        $password = Str::random(10);
        $attributes['password'] = $password;

        return parent::create($attributes);
    }
}
