<div class="relative py-4 px-6  h-52 text-center text-sm sm:px-14">
    <div x-cloak class="h-44" x-show="! showLoaders">
        @if(count($products) > 0 || count($coupons) > 0)
            <style>
                .splide__pagination__page.is-active {
                    background: #333;
                }
            </style>
            
            <div
                x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            perPage: 2,
                            gap: '0.5rem',
                            breakpoints: {
                                640: {
                                    perPage: 1,
                                },
                            },
                        }).mount()
                    },
                }"
            >
            <section x-transition x-ref="splide" class="splide" aria-label="Splide/Alpine.js Carousel Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($coupons as $coupon)
                        <li class="relative rounded-lg splide__slide flex flex-col items-center justify-center pb-8">
                            <h2 class="absolute top-1 left-1 p-4 h-8 text-gray-800">
                                {{$coupon['title']}}
                            </h2>
                            
                            <img class="w-full h-44 rounded-lg" src="{{Storage::disk('s3')->url($coupon['thumbnail_url'])}}" alt="placeholder image">
                        </li>
                        @endforeach
         
                        @foreach($products as $product)
                        <li class="relative rounded-lg splide__slide  flex flex-col items-center justify-center pb-8">
                            <h2 class="absolute top-1 left-1 p-4 h-8 text-gray-800">
                                {{$product['title']}}
                            </h2>

                            <img class="w-full h-44 rounded-lg" src="{{Storage::disk('s3')->url($product['thumbnail_url'])}}" alt="placeholder image">
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
        @else
            <!-- Heroicon name: outline/users -->
            <svg class="mx-auto h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <p class="mt-4 font-semibold text-gray-900">No product found</p>
            <p class="mt-2 text-gray-500">We couldn’t find anything with that term. Please try again.</p>
        @endif
    </div>
    <div x-cloak x-show="showLoaders">
        @livewire('walletapp::loader')
        <span style="left:37.5%;" class="absolute top-32 text-gray-500 text-sm">We are looking for your request!</span>
    </div>
</div>