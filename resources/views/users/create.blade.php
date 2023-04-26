@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Add New Book</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title"
                       class="block">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="w-full"
                       value="{{ old('title') }}"
                       required>
                @error('title')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="author"
                       class="block mb-2">Author</label>
                <input type="text"
                       name="author"
                       id="author"
                       class="w-full border-2 border-gray-200 p-2 rounded"
                       value="{{ old('author') }}"
                       required
                >
                @error('author')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="role" class="block mb-2">Category</label>
                <select name="role" id="role" class="w-full border-2 border-gray-200 p-2 rounded">
                    <option value="{{\App\Models\User::ROLE_EMPLOYEE}}">{{ \App\Models\User::ROLE_EMPLOYEE }}</option>
                    <option value="{{\App\Models\User::ROLE_READER}}">{{ \App\Models\User::ROLE_READER }}</option>
                </select>
                @error('category_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save</button>
        </form>
    </div>
@endsection
