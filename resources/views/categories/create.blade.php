@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Add New Category</h1>

        <form action="{{ route('categories.store') }}" method="POST">
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
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save</button>
        </form>
    </div>
@endsection
