<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Services\EmployeeLoginLinkSenderInterface;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class UserController extends ModelController
{
    public function __construct(
        private readonly EmployeeLoginLinkSenderInterface $employeeLoginLinkSender,
        UserRepositoryInterface                           $repository,
    )
    {
        parent::__construct($repository);
    }

    public function index(): View
    {
        $users = $this->repository->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create(): View|Application|Factory|ApplicationContract
    {
        return view('users.edit', [
            'title' => 'Create new user',
            'action' => 'users.store',
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = $this->repository->create($request->validated());

        if ($user->isEmployee()) {
            $this->employeeLoginLinkSender->sendLoginLink($user);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): View|Application|Factory|ApplicationContract
    {
        return view('users.edit', [
            'user' => $user,
            'title' => 'Edit user ' . $user->name,
            'action' => 'users.update',
            'method' => 'PATCH'
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $this->repository->update($user, $validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->repository->delete($user);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
