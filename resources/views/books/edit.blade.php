@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{$title}}</h1>
        <x-form action="{{ route('books.store') }}" method="POST">
            <x-input title="Title"
                     name="title"
                     :value="$book->title ?? ''"
                     required

            />
            <x-input title="Author"
                     name="author"
                     :value="$book->author ?? ''"
                     required
            />
            <x-select title="Category"
                      name="category_id"
            >
                @foreach($categories as $category)
                    <x-select-option :title="$category->title"
                                     :name="$category->id"
                                     :selected="($book->category_id ?? false) === $category->id"
                    />
                @endforeach
            </x-select>
        </x-form>
    </div>
@endsection
