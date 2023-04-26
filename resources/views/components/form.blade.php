<form action="{{ $action }}"
      method="{{ $method === 'GET' ? 'GET' : 'POST' }}"
      enctype="multipart/form-data">
    @csrf
    @if ($method !== 'GET' && $method !== 'POST')
        @method($method)
    @endif
    {{ $slot }}
    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="{{ route('admin') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
        <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Save
        </button>
    </div>
</form>
