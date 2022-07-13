<nav class="flex ml-4 mt-4" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <a href="{{$title['href']}}" class="text-white hover:text-white">
            <!-- Heroicon name: solid/home -->
            <span class="link link-underline text-2xl">{{$title['tag']}}</span>
          </a>
        </div>
      </li>
      @foreach ($items as $item)
        <li class="mt-1">  
            <div class="flex items-center">
            <!-- Heroicon name: solid/chevron-right -->
            <svg class="flex-shrink-0 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            @if(isset($item['href']))
                <a href="{{$item['href']}}" class="link link-underline ml-4 text-sm font-medium text-white hover:text-gray-100">{{$item['tag']}}</a>
            @elseif(isset($item['array_key']))
            <a href="#" wire:click="executeBreadcrumb({{$item['array_key']}})" class="link link-underline ml-4 text-sm font-medium text-white hover:text-gray-100">{{$item['tag']}}</a>            
            @endif
            </div>
        </li>
      @endforeach
    </ol>

<style>
	.link-underline {
		border-bottom-width: 0;
		background-image: linear-gradient(transparent, transparent), linear-gradient(#fff, #fff);
		background-size: 0 2px;
		background-position: 0 100%;
		background-repeat: no-repeat;
		transition: background-size .2s ease-in-out;
	}

	.link-underline-black {
		background-image: linear-gradient(transparent, transparent), linear-gradient(#F2C, #F2C)
	}

	.link-underline:hover {
		background-size: 100% 2px;
		background-position: 0 100%
	}
</style>
</nav>
