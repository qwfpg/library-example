@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Books</h1>
            <a href="{{ route('books.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add New Book</a>
        </div>
        <form action="{{ route('import_books') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="import_file" class="block text-sm font-medium text-gray-700">Choose file to import</label>
                <input type="file" id="import_file" required name="import_file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Import books</button>
        </form>
        <table class="w-full table-auto">
            <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Author</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-4 py-2">{{ $book->title }}</td>
                    <td class="px-4 py-2">{{ $book->author }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('books.edit', $book->id) }}" class="text-green-500">Edit</a> |
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
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
            {{ $books->links() }}
        </div>
    </div>
@endsection
