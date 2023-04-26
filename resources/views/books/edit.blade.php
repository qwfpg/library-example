@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{$title}}</h1>
        <x-form :action="route($action, $book ?? null)"
                :method="$method ?? 'POST'"
                :indexRoute="'books.index'"
        >
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
            @if($book->cover ?? false)
                <img src="{{ asset('storage/' . $book->cover) }}" alt="Обложка книги">
            @endif
            <x-input title="Cover"
                     name="cover"
                     type="file"
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
