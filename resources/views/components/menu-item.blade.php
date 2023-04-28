<a href="{{route($route)}}"
   class="{{Route::is($route) ? 'bg-gray-900' : 'hover:text-white' }} text-white rounded-md px-3 py-2 text-sm font-medium"
    {{Route::is($route) ? 'aria-current="page"' : ''}}>{{$name}}</a>
