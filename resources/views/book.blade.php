@extends('layouts.site')

@section('title', $book->title)

@section('content')
    <div class="container mx-auto mt-12">
        <div class="p-6">
            <div class="flex">
                <img src="{{ $book->getCover() }}" alt="{{ $book->title }}" class="w-1/3 rounded-lg mr-6">
                <div class="flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">{{ $book->title }}</h2>
                        <p class="text-lg text-gray-700 mb-4">by {{ $book->author }}</p>
                        <p class="text-gray-700 font-semibold">
                            <a href="{{route('category-books.index', $book->category->slug)}}">
                                Category: {{ $book->category->title }}
                            </a></p>
                        <p class="text-gray-700 font-semibold">Rating:
                            <x-rating :rating="$book->rating"/>
                        </p>
                        <p class="text-gray-600 mt-4">{{ $book->description }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4">Comments</h3>
                @if (Auth::guest())
                    <p class="text-left mt-4 mb-4">
                        <a href="{{ route('register') }}" class="text-blue-500 underline">Register</a>, to leave a
                        comment
                    </p>
                @endif
                @if (auth()->check())
                    <div class="mt-8">
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <label> <textarea name="body" rows="5"
                                              class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none"
                                              placeholder="Comment..."></textarea> </label>
                            @error('body')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                            <button type="submit"
                                    class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Submit
                            </button>
                        </form>
                    </div>
                @endif
                <div class="mt-8">
                    @forelse ($book->comments as $comment)
                        <div class="bg-white p-4 rounded-lg mb-4">
                            <div class="text-gray-700 mb-2">
                                <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->diffForHumans() }}
                                )
                            </div>
                            <div>{{ $comment->body }}</div>
                        </div>
                    @empty
                        <p>No comments yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
