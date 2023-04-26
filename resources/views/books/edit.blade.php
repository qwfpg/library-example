@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit Book</h1>
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ $book->title }}" class="w-full border-2 border-gray-200 p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="author" class="block mb-2">Author</label>
                <input type="text" name="author" id="author" value="{{ $book->author }}" class="w-full border-2 border-gray-200 p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="category" class="block mb-2">Category</label>
                <select name="category" id="category" class="w-full border-2 border-gray-200 p-2 rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update</button>
        </form>
    </div>
@endsection
