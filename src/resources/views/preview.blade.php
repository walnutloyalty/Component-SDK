<div x-data="{type: 'coupon'}">

    <div :class="{ 'z-50': 'false' }">
    <div style="background: {{$primary_color ?? '#fff'}}" class='bg-white rounded border-y-2 border-dashed border-slate-400 shadow-lg py-6 overflow-hidden'>
        <div class='px-4 pb-4 flex justify-between'>
            <div class='mr-auto'>
                <img src='{{auth()->user()->current_organization->logoURL}}' alt='Brand logo'
                        class='block w-auto h-auto' style='max-height: 2.5rem;'>
            </div>
            <div>
                <p class="text-gray-500 text-sm"
                    style="color: {{$label_color ?? '#000000'}}">
                    Status</p>
                <p style="color: {{$text_color ?? '#000000'}}">
                        {{__("Actief")}}
                </p>
            </div>
        </div>
        <div class='bg-white w-full aspect-w-12 aspect-h-5'>
            <img src='@if(isset($thumbnail_url)) {{$thumbnail_url}} @else {{auth()->user()->current_organization->logoURL}} @endif'
                    alt='Thumbnail'
                    class='w-full minh-full object-center object-contain'>
                <div class="text-center inset-2 absolute">
                    @if(isset($showTitle) && $showTitle)
                        <h2 class="text-xl font-extrabold text-gray-100 line-clamp-2"
                            style="text-shadow: 0px 0px 10px rgb(0 0 0 / 75%);">{{$title ?? 'Title placeholder'}}</h2>
                    @endif
                    @if(isset($showSubtitle) && $showSubtitle)
                        <h4 class="text-lg text-gray-100 line-clamp-2"
                            style="text-shadow: 0px 0px 10px rgb(0 0 0 / 75%);">{{$subtitle ?? 'Subtitle placeholder'}}</h4>
                    @endif
                </div>
        </div>
        <div class='px-4 mt-6'>
            <div class='flex justify-between'>
                <p style="color: {{$label_color ?? '#000'}};" class='text-gray-600 text-sm'>{{__("Naam")}}</p>
                <p style="color: {{$label_color ?? '#000'}};" class='text-gray-600 text-sm'>{{$expirationLabel ?? 'Expires at'}}</p>
            </div>
            <div class='flex justify-between'>
                <p style="color: {{$text_color ?? '#000'}};" class='truncate'>{{auth('users')->user()->name}}</p>
                @if (isset($pass['date']))
                    <p style="color: {{$text_color}}">{{Carbon::now()->format('d-m-Y')}}</p>
                @else
                    @if(isset($expirationDate))
                        <p style="color: {{$text_color}}">
                            {{ Carbon\Carbon::now->addDays($expirationDays)->format('d-m-Y') }}
                        </p>
                    @else
                        <p style="color: {{$text_color ?? '#000000'}}">{{ Carbon\Carbon::now()->format('d-m-Y')}}</p>
                    @endif
                @endif
            </div>
        </div>
        <div >
            
                <div style="padding:1rem" class=' bg-white mx-auto mt-6 w-40 h-40 rounded-lg shadow-2xl flex justify-center'>
                    {!! QrCode::size(135)->generate('https://youtu.be/dQw4w9WgXcQ') !!}
                </div>
                <p class='text-center font-medium text-lg'>
                    WLLT12341234
                </p>
        </div>
    </div>
    @if (\Browser::IsMobile() && \Browser::isMac())
        @if (isset($pass['code']['qr_code']))
            <div x-show="pass" class='mt-5 sm:mt-6 text-center sm:hidden'>
                <div class="relative z-0 inline-flex space-x-3">
                    <button type="button" wire:click="download('{{json_encode(['id' => $pass['id'],'code' => $pass['code']['code']])}}')" class="primary_button relative inline-flex items-center px-5 py-3.5 rounded-xl border border-gray-300 bg-white text-lg font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        <svg wire:loading.inline wire:target="download" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.inline wire:target="download" style="display: none">Downloaden...</span>
                        <span wire:loading.remove wire:target="download">Download</span>
                    </button>
                    <button type="button" wire:click="setPass('{{$pass['code']['qr_code']}}')" class="primary_button relative inline-flex items-center px-5 py-3.5 rounded-xl border border-gray-300 bg-white text-lg font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        <svg wire:loading.inline wire:target="setPass" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.inline wire:target="setPass" style="display: none">Inchecken...</span>
                        <span wire:loading.remove wire:target="setPass">Check-in</span>
                    </button>
                </div>
            </div>
        @endif
    @elseif(\Browser::IsMobile())
        @if(count(cache()->get($domain)['locations']) > 0)
            <div x-show="active" class='mt-5 sm:mt-6 text-center sm:hidden'>
                <div x-data="{ open: false }" class="relative z-0 inline-flex shadow-sm rounded-md">
                    <button type="button" wire:click="setPass('@if (isset($pass['code']['qr_code'])) {{$pass['code']['qr_code']}} @endif')" class="primary_button relative inline-flex items-center px-5 py-3.5 rounded-xl border border-gray-300 bg-white text-lg font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        <svg wire:loading.inline wire:target="setPass" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.inline wire:target="setPass" style="display: none">Inchecken...</span>
                        <span wire:loading.remove wire:target="setPass">Check-in</span>
                    </button>
                </div>
            </div>
        @endif
    @endif
    </div>
</div>