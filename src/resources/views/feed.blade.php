<section x-data="{showFeed: false}" x-init='$nextTick(() => {
    setTimeout(() => { showFeed = true; }, 100)
 });' aria-labelledby="announcements-title">
    <div class="rounded-lg bg-white overflow-hidden shadow">
        <div class="p-6">
            <h2 class="text-base font-medium text-gray-900" id="announcements-title">{{$title ?? 'Feed component'}}</h2>
            <div style="height:22.5vh;" class="overflow-y-auto flow-root mt-6">
                <ul role="list" class="-my-5 divide-y divide-sky-200">
                    @if(count($items) > 0)
                        @foreach($items as $item)
                            <li x-cloak x-show="showFeed"
                            x-transition:enter="opacity-0 transition ease-in-out duration-500 transform"
                            x-transition:enter-start="opacity-0 -translate-x-full"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="opacity-100 transition ease-in-out duration-500 transform"
                            x-transition:leave-start="opacity-0 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-full"
                            class="py-5">
                                <div class=" relative focus-within:ring-2 focus-within:ring-cyan-500">
                                    <h3 class="text-sm font-semibold text-gray-800">   
                                        <a href="#" @if(isset($item['emit_reference'])) @click="$wire.emit('feed{{ucfirst($title)}}Broadcast', {{$item['emit_reference']}})" @endif class="hover:underline focus:outline-none">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{$item['title']}}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-600 line-clamp-2">{!! $item['description'] !!}</p>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li x-cloak x-show="showFeed"
                        x-transition:enter="opacity-0 transition ease-in-out duration-500 transform"
                        x-transition:enter-start="opacity-0 -translate-x-full"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="opacity-100 transition ease-in-out duration-500 transform"
                        x-transition:leave-start="opacity-0 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-full" class="py-5">
                            <div class="relative focus-within:ring-2 focus-within:ring-cyan-500">
                                <h3 class="text-sm font-semibold text-gray-800">
                                    <a  class="hover:underline focus:outline-none">
                                        <!-- Extend touch target to entire panel -->
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        No items yet...
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 line-clamp-2">When you start generating traffic we will post the latest data we have here so you never miss anything</p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>