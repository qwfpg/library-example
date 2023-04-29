<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function paginate(int $count, array $with = []): LengthAwarePaginator;

    public function findBySlug(string $slug): ?Model;

    public function all(): Collection;

    public function find(int $id): ?Model;

    public function create(array $attributes): Model;

    public function update(Model $model, array $attributes): bool;

    public function delete(Model $model): bool;

}
