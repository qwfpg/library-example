<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface BookRepositoryInterface
{
    public function findByCategorySlug(string $categorySlug, int $perPage): LengthAwarePaginator;
}
