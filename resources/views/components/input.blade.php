<div class="mb-4">
    <label for="{{$name}}"
           class="block">{{$title}}</label>
    <input type="{{$type}}"
           name="{{$name}}"
           id="{{$name}}"
           value="{{ $value }}"
           {{isset($min) ? 'min=' . $min : ''}}
           {{isset($max) ? 'max=' . $max : ''}}
           class="w-full"
        {{$required === true ? 'required' : ''}}
    >
    @error($name)
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>
