<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ModelController;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends ModelController
{
    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function index(): AnonymousResourceCollection
    {
        $categories = $this->repository->paginate(10);
        return CategoryResource::collection($categories);
    }
}
