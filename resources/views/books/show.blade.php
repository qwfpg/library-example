@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{ $book->title }}</h1>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Category:</strong> {{ $book->category->name }}</p>
        <div class="mt-6">
            <a href="{{ route('books.edit', $book->id) }}" class="bg-green-500 text-white py-2 px-4 rounded">Edit</a>
            <a href="{{ route('books.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded">Back to Books</a>
        </div>
    </div>
@endsection
