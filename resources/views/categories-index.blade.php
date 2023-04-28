@extends('layouts.site')

@section('title', 'Categories')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
            @foreach ($categories as $category)
                <a href="{{route('category-books.index', $category->slug)}}" class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">{{ $category->title }}</h3>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
