<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function __construct(Book $book)
    {
        parent::__construct($book);
    }

    public function findByCategorySlug(string $categorySlug, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->with('category')
            ->latest()
            ->paginate($perPage);
    }
}
