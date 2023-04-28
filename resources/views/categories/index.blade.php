@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Books</h1>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add New Category</a>
        </div>
        <table class="w-full table-auto">
            <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-4 py-2">{{ $category->title }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-green-500">Edit</a> |
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
