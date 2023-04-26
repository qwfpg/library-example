<div class="mb-4">
    <label for="category_id"
           class="block mb-2">{{$title}}</label>
    <select name="{{$name}}" id="{{$name}}" class="w-full border-2 border-gray-200 p-2 rounded">
        {{$slot}}
    </select>
    @error('category_id')
    <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>
