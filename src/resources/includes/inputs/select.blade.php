
<div style="margin:0;" class="{{$extra_classes ?? ''}}">
    <label for="{{$id ?? 'input'}}" class="block text-sm font-medium text-gray-700">{{$label ?? 'input'}}</label>
    <select @if(isset($model)) wire:model="{{$model}}" @endif  @if(isset($call_component_update) && $call_component_update) wire:change="componentUpdated('{{$model}}')" @endif name="{{$id ?? 'input'}}" id="{{$id ?? 'input'}}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        <option value="">Choose an option</option>
        @foreach($options ?? [] as $option)
            <option value="{{$option['value']}}">{{$option['name']}}</option>
        @endforeach
    </select>
  </div>
  