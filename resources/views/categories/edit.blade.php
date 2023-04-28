@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{$title}}</h1>
        <x-form :action="route($action, $category ?? null)"
                :method="$method ?? 'POST'"
                :indexRoute="'categories.index'"
        >
            <x-input title="Title"
                     name="title"
                     :value="$category->title ?? ''"
                     required

            />
        </x-form>
    </div>
@endsection
