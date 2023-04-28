@extends('layouts.site')

@section('title', $category->title ?? 'Home')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
            @foreach ($books as $book)
                <a href="{{route('site-books.show', $book->slug)}}" class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img class="w-full h-48 object-cover" src="{{ $book->getCover() }}" alt="{{ $book->title }}">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-500 mt-2">Author: {{ $book->author }}</p>
                        <p class="text-sm text-gray-500 mt-2">Category: {{ $book->category->title }}</p>
                        <x-rating :rating="$book->rating"/>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </div>
@endsection
