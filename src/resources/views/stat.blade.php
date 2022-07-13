
 <div class="relative" x-data="{
    selectedId: null,
    init() {
        // Set the first available tab on the page on page load.
        this.$nextTick(() => this.select(this.$id('tab', 1)))
    },
    select(id) {
        this.selectedId = id
    },
    isSelected(id) {
        return this.selectedId === id
    },
    whichChild(el, parent) {
        return Array.from(parent.children).indexOf(el) + 1
    },
}"
x-id="['tab']"
>
    <svg x-tooltip="{{$tooltip ?? 'tooltip'}}" class="z-10 absolute top-4 right-4 text-gray-500 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <ul wire:ignore  x-ref="tablist"
        x-cloak
        @keydown.right.prevent.stop="$focus.wrap().next()"
        @keydown.home.prevent.stop="$focus.first()"
        @keydown.page-up.prevent.stop="$focus.first()"
        @keydown.left.prevent.stop="$focus.wrap().prev()"
        @keydown.end.prevent.stop="$focus.last()"
        @keydown.page-down.prevent.stop="$focus.last()" class="relative border-b border-gray-200 -mb-px flex space-x-2" aria-label="Tabs">
        @foreach ($tabs as $key => $tab)
        <li >
            <button
            role="tab"
            :id="$id('tab', whichChild($el.parentElement, $refs.tablist))"
                @click="select($el.id)"
                @mousedown.prevent
                @focus="select($el.id)"
                type="button"
                :tabindex="isSelected($el.id) ? 0 : -1"
                :aria-selected="isSelected($el.id)"
                :class="isSelected($el.id) ? ' border-sky-500 text-sky-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 '" href="#" class="ml-4 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"> {{$key ?? 'tab'}} 
            </button>
        </li>
        @endforeach
    </ul>
    <div class="flex h-full w-full"
        x-transition:enter="opacity-0 transition ease-in-out duration-500 transform"
        x-transition:enter-start="opacity-0 -translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="opacity-100 transition ease-in-out duration-500 transform"
        x-transition:leave-start="opacity-0 translate-x-0"
        x-transition:leave-end="opacity-0 -translate-x-full">
        @foreach($tabs as $tab)
            <section class='min-w-full'
            x-transition:enter.duration.600ms
            x-transition:leave.duration.600ms
            x-transition.opacity
            x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
            :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))"
            role="tabpanel">
            <!-- This example requires Tailwind CSS v2.0+ -->
                    @foreach($tab as $data)
                    <div class="px-4 py-2 sm:p-3">
                        <dt class="text-base font-normal text-gray-900">Total Subscribers</dt>
                        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold text-sky-600">
                            71,897
                            @if(isset($comparison) && $comparison)
                                <span class="ml-2 text-sm font-medium text-gray-500"> from 70,946 </span>
                            @endif
                        </div>
                            @if(isset($percentage) && $percentage)
                                <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 md:mt-2 lg:mt-0">
                                    <!-- Heroicon name: solid/arrow-sm-up -->
                                    <svg class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only"> Increased by </span>
                                    12%
                                </div>
                            @endif
                        </dd>
                    </div> 

                    @endforeach
            </section>
        @endforeach   
    </div>
 </div>