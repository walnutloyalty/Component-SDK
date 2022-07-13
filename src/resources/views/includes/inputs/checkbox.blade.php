<div style="margin:0;" class="@if($type === 'hidden') hidden @endif {{$extra_classes ?? ''}}">
    <div class="flex items-center h-5">
        <input id="{{$id ?? 'input'}}"  @if(isset($call_component_update) && $call_component_update) wire:change="componentUpdated('{{$model}}')" @endif  aria-describedby="{{$id ?? 'input'}}-description" name="{{$id ?? 'input'}}" wire:model="{{$model}}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
        <label for="{{$id ?? 'input'}}" class="ml-4 text-sm text-gray-700">{{$label ?? 'input'}}</label>
    </div>
    @error($model) <span class="mt-1 text-red-500">{{ $message }}</span> @enderror
</div>