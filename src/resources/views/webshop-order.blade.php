<div class="col-span-full" x-data="{openShopOrder: false}">
    <div x-show="! openShopOrder">
        @livewire('components.model-select', [
            'type' => 'brands',
            'model' => 'brands',
            'id' => 'brands',
            'label' => 'Shops',
            'mode' => $mode ?? null,
            'multiple' => true,
            'emit_to_parent' => true,
            'parent_listener' => $model,
        ])
    </div>
   
    <div x-show="openShopOrder">
           @foreach($order as $key => $brand)

            <div>
                <label for="{{$brands[$key]}}" class="block text-sm font-medium text-gray-700">{{$brands[$key]}}</label>
                <div class="mt-1">
                <input type="number" wire:model="order.{{$key}}" name="{{$brands[$key]}}" id="{{$brands[$key]}}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="order">
                </div>
            </div>
  
           @endforeach
    </div>
    @if (count($order) > 0)
    <span x-on:click="openShopOrder = openShopOrder !== true">
        <button type="button" class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Change shop order</button>
    </span>
    @endif
</div>
