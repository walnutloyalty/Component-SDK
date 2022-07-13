<div class="bg-white m-4 grid sm:gap-4 sm:grid-cols-5 overflow-hidden shadow rounded-lg">
 
    <div x-data="{ active: 1 }" class="w-full mx-auto ">
        <div x-data="{
            id: 1,
            get expanded() {
                return this.active === this.id
            },
            set expanded(value) {
                this.active = value ? this.id : null
            },
        }" role="region" >
            <h2>
                <button
                    x-on:click="expanded = !expanded"
                    :aria-expanded="expanded"
                    class="flex items-center justify-between w-full  text-md px-6 py-4"
                >
                    <span>search</span>
                    <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                    <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                </button>
            </h2>
           
            <div class='mx-4' x-show="expanded" x-collapse>
                <div>
                    <label for="search" class="sr-only">Email</label>
                    <input wire:model="search" type="text" name="search" id="search" class="shadow-sm focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="search">
                </div>
            </div>
        </div>
        @if(isset($filters))
        <div x-data="{
            id: 2,
            get expanded() {
                return this.active === this.id
            },
            set expanded(value) {
                this.active = value ? this.id : null
            },
        }" role="region">
            <h2>
                <button
                    x-on:click="expanded = !expanded"
                    :aria-expanded="expanded"
                    class="flex items-center justify-between w-full font-bold text-xl px-6 py-4"
                >
                    <span>Question #2</span>
                    <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                    <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                </button>
            </h2>

            <div x-show="expanded" x-collapse>
                <div class="pb-4 px-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. In magnam quod natus deleniti architecto eaque consequuntur ex, illo neque iste repellendus modi, quasi ipsa commodi saepe? Provident ipsa nulla earum.</div>
            </div>
        </div>
        @endif
    </div>
    <div class="sm:col-start-2 sm:col-span-4 divide-y divide-gray-200">
        <div class="h-10 mt-4">
            <ul class="mx-4 flex mt-2 relative">
                @if($create)
                <li class="">
                    <button type="button" @click="$wire.{{$create['type']}}('{{$create['handler']}}')" class="right-0 top-0 absolute inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">new</button>
                </li>
                @endif
                <li class="text-gray-700">Filters:</li>
                @if($search)
                <li x-transition class="inline-flex ml-4 items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-200  text-gray-800">
                    {{$search}}
                </li>
                @endif
            </ul>
        </div>
        <ul style="max-height: 80vh;" role="list" class="overflow-y-auto ">       
            @if (count($current_stack) > 0)
                @foreach($current_stack as $stack_key => $value)
                <li class="relative" x-data="{ webshopInformation : false }">
                    <div class="block hover:bg-gray-50">
                        <div class="px-4 py-4 md:px-6 flex items-center">
                            @if(count($options) > 0)
                            <div class="md:mr-2 pr-4 hidden md:block border-r border-gray-200">
                                <div class="relative inline-block text-left">
                                    <button x-tooltip="{{__(array_search(current($options), $options))}}" type="button" 
                                            wire:click="executeOption('{{array_search(current($options), $options)}}', {{$stack_key}})"
                                            class="inline-flex relative items-center justify-center p-1 border border-transparent rounded-full shadow-sm @if(isset(current($options)['color'])) bg-{{current($options)['color']}}-100 hover:bg-{{current($options)['color']}}-300 focus:ring-{{current($options)['color']}}-500 @else bg-sky-100 hover:bg-sky-300 focus:ring-sky-500 @endif focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                                        @if(! isset(current($options)['svg']))
                                        <svg class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                        @elseif(current($options)['svg'] === 'inspect')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="@if(isset(current($options)['color'])) text-{{current($options)['color']}}-400  @else text-sky-400 @endif h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        @elseif(current($options)['svg'] === 'edit')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="@if(isset(current($options)['color'])) text-{{current($options)['color']}}-400  @else text-sky-400 @endif h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        @elseif(current($options)['svg'] === 'archive')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="@if(isset(current($options)['color'])) text-{{current($options)['color']}}-400  @else text-sky-400 @endif h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                        @endif
                                    </button>
                                </div>
                            </div>
                            @endif
                            <div class="w-full flex">
                                @if(count($image_keys) > 0)
                                    @foreach($image_keys as $key)
                                        <div class="relative w-20">
                                            <img class="h-10 w-10 ml-4 mt-1 rounded-full" src="{{$value[$key]}}" alt="">
                                        </div>
                                    @endforeach
                                @endif
                                <div class="w-full">
                                    <div class="flex items-center justify-between">
                                        @if (! in_array(array_search(current($value), $value), $image_keys) && array_search(current($value), $value) !== 'id' )
                                            <div>
                                                <div x-tooltip="{{str_replace('_', ' ', array_search(current($value), $value))}}" class="px-4 py-1 inline-flex items-center justify-center text-sm leading-5 relative font-semibold rounded-full text-sky-800 bg-sky-100">
                                                    {{current($value)}}
                                                </div>
                                            </div>
                                        @endif
    
                                    </div>
                                    <div class="mt-2 lg:flex lg:justify-between">
                                        <div class="md:flex">
                                            @foreach($value as $array_key => $array_value) 
                                                @if ( ! in_array($array_key, $hidden) && ! in_array($array_key, $image_keys) && $array_value !== current($value) &&  $array_value !== 'id')
                                                    <div x-tooltip="{{str_replace('_', ' ', $array_key)}}" class="flex">
                                                        @if(isset($svgs[$array_key]))
                                                            @if($svgs[$array_key] === 'info')
                                                                <svg xmlns="http://www.w3.org/2000/svg"  class="cursor-pointer text-gray-500 h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer text-gray-500 h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                                </svg>
                                                            @endif
                                                        @endif
                                                    <p  class="cursor-pointer md:mr-2 pr-4 hidden md:block  flex items-center text-sm text-gray-500"> 
                                                        {{$array_value}}
                                                    </p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(count($options) > 0)
                                <div class="md:ml-4 md:pl-4 hidden md:block border-l border-gray-200">
                                    <div class="relative flex inline-block text-left">
                                        @foreach($options as $option_key => $option)
                                            @if($option_key !== array_search(current($options), $options))
                                                <button x-tooltip="{{__($option_key)}}" type="button"
                                                        wire:click="executeOption('{{$option_key}}', {{$stack_key}})"
                                                        class="inline-flex relative mr-4 items-center justify-center p-1 border border-transparent rounded-full shadow-sm @if(isset($option['color'])) bg-{{$option['color']}}-100 hover:bg-{{$option['color']}}-300 focus:ring-{{$option['color']}}-500 @else bg-sky-100 hover:bg-sky-300 focus:ring-sky-500 @endif focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                                                    @if(! isset($option['svg']))
                                                    <svg class="h-5 w-5" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                    </svg>
                                                    @elseif($option['svg'] === 'inspect')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="@if(isset($option['color'])) text-{{$option['color']}}-400  @else text-sky-400 @endif h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    @elseif($option['svg'] === 'edit')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="@if(isset($option['color'])) text-{{$option['color']}}-400  @else text-sky-400 @endif h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    @elseif($option['svg'] === 'archive')
                                                
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="@if(isset($option['color'])) text-{{$option['color']}}-400  @else text-sky-400 @endif h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                        </svg>
                                                    @endif
                                            
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            @else
                <p class="text-center text-gray-700 text-md">There doesn't seem to be any data...</p>
            @endif
        </ul>
    </div>
   
    <!-- This example requires Tailwind CSS v2.0+ -->
<div class="col-span-full bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
    <div class="flex-1 flex justify-between sm:hidden">
      <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
      <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p x-tooltip="Filter not applied on counter" class="text-sm text-gray-700">
          <span class="font-medium">{{count($unfiltered)}}</span>
          results
        </p>
      </div>
      <div>
        <div class="flex-1 flex justify-between sm:justify-end">
            <a href="#"  wire:click="lastPage"   class="relative inline-flex items-center @if($page - 1 < 0) cursor-default bg-gray-100 @endif px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
            <a href="#"  wire:click="nextPage" class="ml-3 relative inline-flex @if($page + 2 > count($data)) cursor-default bg-gray-100 @endif items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
          </div>
      </div>
    </div>
  </div>
  </div>
  
