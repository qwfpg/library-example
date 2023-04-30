<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ModelController;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Services\EmployeeLoginLinkSenderInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ModelController
{
    public function __construct(
        private readonly EmployeeLoginLinkSenderInterface $employeeLoginLinkSender,
        UserRepositoryInterface                           $repository)
    {
        parent::__construct($repository);
    }

    public function index(): AnonymousResourceCollection
    {
        $users = $this->repository->paginate(10);

        return UserResource::collection($users);

    }

    public function store(StoreUserRequest $request): UserResource
    {
        $validated = $request->validated();
        $user = $this->repository->create($validated);

        if ($user->isEmployee()) {
            $this->employeeLoginLinkSender->sendLoginLink($user);
        }

        return new UserResource($user);
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();
        $this->repository->update($user, $validated);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->repository->delete($user);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
