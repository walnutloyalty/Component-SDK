<div style="margin:0;" class="@if($type === 'hidden') hidden @endif {{$extra_classes ?? ''}}">
    <label for="{{$id ?? 'input'}}" class=" block text-sm font-medium text-gray-700">{{$label ?? 'input'}}</label>
    <div class="mt-1">
        <input @if(isset($model))  @if(isset($call_component_update) && $call_component_update) wire:change="componentUpdated('{{$model}}')" @endif  wire:model="{{$model}}" @endif type="color" name="{{$id ?? 'input'}}" id="{{$id ?? 'input'}}" class=" shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="{{$placeholder ?? ''}}">
    </div>
    @if(isset($model))
    @error($model) <span class="mt-1 text-red-500">{{ $message }}</span> @enderror
    @endif
</div>
