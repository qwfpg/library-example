@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{$title}}</h1>
        <x-form :action="route($action, $user ?? null)"
                :method="$method ?? 'POST'"
                :indexRoute="'users.index'"
        >
            <x-input title="Name"
                     name="name"
                     :value="$user->name ?? ''"
                     required

            />
            <x-input title="Email"
                     name="email"
                     :value="$user->email ?? ''"
                     required

            />

            <x-select title="Role"
                      name="role"
            >
                @foreach(\App\Enums\UserRoles::cases() as $role)
                    <x-select-option :title="$role->name"
                                     :name="$role->value"
                                     :selected="($user->role ?? false) === $role->value"
                    />
                @endforeach
            </x-select>

        </x-form>
    </div>
@endsection
