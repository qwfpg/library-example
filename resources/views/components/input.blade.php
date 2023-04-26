<div class="mb-4">
    <label for="{{$name}}"
           class="block">{{$title}}</label>
    <input type="text"
           name="{{$name}}"
           id="{{$name}}"
           value="{{ $value }}"
           class="w-full"
        {{$required === true ? 'required' : ''}}
    >
    @error($name)
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>
