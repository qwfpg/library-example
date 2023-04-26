@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit user</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ $user->name }}"
                       class="w-full border-2 border-gray-200 p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="author" class="block mb-2">Author</label>
                <input type="text" name="author" id="author" value="{{ $user->email }}"
                       class="w-full border-2 border-gray-200 p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="category" class="block mb-2">Category</label>
                <select name="role" id="role" class="w-full border-2 border-gray-200 p-2 rounded">
                    @foreach(['employee', 'reader'] as $role)
                        <option
                            value="{{ $user->role }}" {{ $user->role === $role? 'selected' : '' }}>{{ $role}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update</button>
        </form>
    </div>
@endsection
