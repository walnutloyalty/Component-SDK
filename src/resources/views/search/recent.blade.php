<div class="max-h-96 min-w-0 flex-auto scroll-py-4 overflow-y-auto px-6 py-4 sm:h-96">
    <!-- Default state, show/hide based on command palette state. -->
    <h2 class="mt-2 mb-4 text-xs font-semibold text-gray-500">Recent searches</h2>
    <ul class="-mx-2 text-sm text-gray-700" id="recent" role="listbox">
        <!-- Active: "bg-gray-100 text-gray-900" -->
      
        @foreach($list as $item) 
        <li class="group flex cursor-default select-none items-center rounded-md p-2" id="recent-1" role="option" tabindex="-1">
            <span class="ml-3 flex-auto text-xs text-gray-500 truncate">- {{$item}}</span>
            <!-- Not Active: "hidden" -->
            <!-- Heroicon name: solid/chevron-right -->
            <svg class="ml-3 hidden h-5 w-5 flex-none text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
        </li>
     
    @endforeach
    </ul>
</div>
