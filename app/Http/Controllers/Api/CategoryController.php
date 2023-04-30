<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ModelController;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

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

    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $validated = $request->validated();
        $this->repository->update($category, $validated);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $validated = $request->validated();
        $category = $this->repository->create($validated);

        return new CategoryResource($category);
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->repository->delete($category);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
