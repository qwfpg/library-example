<?php

namespace App\Repositories;

use App\Exceptions\DatabaseException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function paginate(int $count, array $with = []): LengthAwarePaginator
    {
        return $this->model::with($with)->latest()->paginate($count);
    }

    public function findBySlug(string $slug, array $with = []): ?Model
    {
        return $this->model::with($with)->where('slug', $slug)->first();
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function findByTitle(string $title): ?Model
    {
        return $this->model->where('title', $title)->first();
    }

    public function create(array $attributes): Model
    {
        try {
            return $this->model->create($attributes);
        } catch (\Throwable $exception) {
            throw new DatabaseException('Error saving data: ' . $exception->getMessage(), 0, $exception);
        }
    }

    public function update(Model $model, array $attributes): bool
    {
        try {
            return $model->update($attributes);
        } catch (\Throwable $exception) {
            throw new DatabaseException('Error updating data: ' . $exception->getMessage(), 0, $exception);
        }
    }

    public function delete(Model $model): bool
    {
        try {
            return $model->delete();
        } catch (\Throwable $exception) {
            throw new DatabaseException('Error deleting data: ' . $exception->getMessage(), 0, $exception);
        }
    }
}
