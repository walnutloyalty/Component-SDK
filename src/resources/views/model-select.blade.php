<div  wire:ingore style="margin:0;" class="@if($type === 'hidden') hidden @endif {{$extra_classes ?? ''}}">
    <label for="{{$model}}" class="block text-sm font-medium text-gray-700">{{$label}}</label>
    <select wire:model="{{$model}}" id="{{$model}}" name="{{$model}}" wire:change="castComponent('{{$model}}')" @if($multiple) multiple @endif class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
      @if(! $multiple)
        <option value="">Choose an option</option>
      @endif
      @foreach($items ?? [] as $item)
        <option value="{{$item['id']}}">{{$item['name']}}</option>
      @endforeach
    </select>
</div>
  