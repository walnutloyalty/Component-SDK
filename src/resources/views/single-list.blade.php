<!-- This example requires Tailwind CSS v2.0+ -->
<nav x-data="{{$x_data}}" class="h-full {{$extra_classes}} rounded-lg  overflow-y-auto" aria-label="Directory">
    @foreach ($block ?? [] as $list)
    <div class="relative">
      <div class="z-10 sticky top-0 border-t border-b border-gray-200 bg-gray-50 px-6 py-1 text-sm font-medium text-gray-500">
        <h3>{{$list['title'] ?? 'Items' }}</h3>
      </div>
      <ul role="list" class="relative z-0 divide-y divide-gray-200">
        @foreach($list['items'] as $item)
        <li
        @if(isset($item['x-show']))
            x-show="{{$item['x-show']}}"
        @endif
        class="bg-white">
          <div class="relative px-6 py-5 flex items-center space-x-3 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-sky-500">
            <div class="flex-1 min-w-0">
                <a href="#"
                    @if($item['type'] === 'emit')
                        wire:click="$emit('{{$item['value']}}')"
                    @endif
                class="focus:outline-none">
                    <!-- Extend touch target to entire panel -->
                    <span class="absolute inset-0" aria-hidden="true"></span>
                    <p class="text-sm font-medium text-gray-900">{{$item['title']}}</p>
                    <p class="text-xs text-gray-500 truncate">{{$item['label']}}</p>
                </a>
            </div>
          </div>
        </li>
        @endforeach
  
      </ul>
    </div>
    @endforeach

  </nav>