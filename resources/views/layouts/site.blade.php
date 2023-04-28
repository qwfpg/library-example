@extends('layouts.base')

@section('body')
    <nav class="bg-white py-4">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('home') }}" class="text-2xl font-semibold text-gray-800">My Library</a>
                </div>
                <div>
                    <ul class="flex items-center">
                        <li><a href="{{ route('home') }}" class="mx-4 text-gray-800 hover:text-gray-600">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
@endsection
