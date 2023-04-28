<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Notifications\NewEmployeeNotification;
use Illuminate\Support\Facades\Password;
use \Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|ApplicationContract
    {
        return view('users.edit', [
            'title' => 'Create new user',
            'action' => 'users.store',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $user = new User($validated);
        $password = Str::random(10);
        $user->password = bcrypt($password);
        $user->save();

        if ($user->role == 'employee') {
            $token = Password::broker()->createToken($user);
            $user->notify(new NewEmployeeNotification($user, $token));
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View|Application|Factory|ApplicationContract
    {
        $user = User::findOrFail($id);

        return view('users.edit', [
            'user' => $user,
            'title' => 'Edit user',
            'action' => 'users.update',
            'method' => 'PATCH'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->filled('password')) {
            $password = bcrypt($validated['password']);
            $validated['password'] = $password;
        } else {
            unset($validated['password']);
        }
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
