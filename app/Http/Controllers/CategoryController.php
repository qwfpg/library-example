<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CategoryController extends ModelController
{
    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function index(): View|Application|Factory|ApplicationContract
    {
        $categories = $this->repository->paginate(10);
        return view('categories.index', compact('categories'));
    }


    public function create(): View
    {
        return view('categories.edit', [
            'title' => 'Create new category',
            'action' => 'categories.store',
        ]);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->repository->create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View|Application|Factory|ApplicationContract
    {
        return view('categories.edit', [
                'category' => $category,
                'title' => 'Edit category',
                'action' => 'categories.update',
                'method' => 'PATCH'
            ]
        );
    }

    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->repository->update($category, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->repository->delete($category);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
