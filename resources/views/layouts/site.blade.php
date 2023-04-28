@extends('layouts.base')

@section('body')
    <nav class="bg-white py-4 container mx-auto px-6">
        <div class="flex  justify-between">
            <div class="flex ">
                <a href="{{ route('home') }}" class="text-2xl font-semibold text-gray-800">My Library</a>
                <ul class="flex items-center">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="mx-4 text-gray-800 hover:text-gray-600">Home</a></li>
                    <li class="nav-item">
                        <a href="{{ route('site-categories.index') }}" class="mx-4 text-gray-800 hover:text-gray-600">Categories</a>
                    </li>
                </ul>
            </div>

            <ul class="navbar-nav flex justify-between">
                @guest
                    <li class="nav-item">
                        <a class="nav-link mx-4" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-4" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->isEmployee())
                    <li class="nav-item">
                        <a class="nav-link mx-4" href="{{ route('books.index') }}">Admin panel</a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->isReader())
                    <li class="nav-item">
                        <span class="nav-link mx-4">{{ Auth::user()->name }}</span>
                    </li>
                @endif
                @auth
                    <li class="nav-item">
                        <a class="nav-link mx-4" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>

        </div>
    </nav>
    @yield('content')
@endsection
