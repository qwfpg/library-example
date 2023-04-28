@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Create new category</h1>
        <x-form :action="route('categories.store')"
                :method="$method ?? 'POST'"
                :indexRoute="'categories.index'"
        >
            <x-input title="Title"
                     name="title"
                     :value="$book->title ?? ''"
                     required
            />
        </x-form>
    </div>
@endsection
