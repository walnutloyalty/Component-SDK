<div @opencreate="open = open !== true " x-data="{menu: false, open: false, changes: false}" class=" flex justify-center">
{{--bg-white bg-opacity-50 backdrop-filter backdrop-blur-lg --}}
    <div
        x-show="open"
        style="display: none"
        x-on:keydown.escape.prevent.stop="open = false"
        role="dialog"
        aria-modal="true"
        x-id="['modal-title']"
        :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 overflow-y-auto z-10"
    >
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-25"></div>

        <div
            x-show="open" x-transition
            x-on:click="open = false"
            class="relative min-h-screen flex items-center justify-center">
            <div
                x-on:click.stop
                x-trap.noscroll.inert="open"
                class="relative place-self-center bg-white rounded-lg w-full md:inline-block md:my-8 md:align-middle max-w-screen-2xl overflow-y-auto"
                style="height: 80vh;">     

                <div x-data="{
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
                    <ul wire:ignore  x-ref="tablist"
                        x-cloak
                        @keydown.right.prevent.stop="$focus.wrap().next()"
                        @keydown.home.prevent.stop="$focus.first()"
                        @keydown.page-up.prevent.stop="$focus.first()"
                        @keydown.left.prevent.stop="$focus.wrap().prev()"
                        @keydown.end.prevent.stop="$focus.last()"
                        @keydown.page-down.prevent.stop="$focus.last()" class="relative border-b border-gray-200 -mb-px flex space-x-2" aria-label="Tabs">
                        @foreach ($tabs as $tab)
                        <li >
                            <button x-show="! menu"
                            role="tab"
                            :id="$id('tab', whichChild($el.parentElement, $refs.tablist))"
                                @click="select($el.id)"
                                @mousedown.prevent
                                @focus="select($el.id)"
                                type="button"
                                :tabindex="isSelected($el.id) ? 0 : -1"
                                :aria-selected="isSelected($el.id)"
                                :class="isSelected($el.id) ? ' border-sky-500 text-sky-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 '" href="#" class="ml-4 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"> {{$tab['name'] ?? 'tab'}} 
                            </button>
                        </li>
                        @endforeach
                        <li style="z-index:70;" class='absolute right-4 mt-1.5'>
                            <button  type="button" 
                                wire:click="submit"
                                class="inline-flex items-center px-3 py-2 border mb-2 border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-white mr-1 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                <span >
                                        Save
                                </span>
                            </button>
                        </li>
                    </ul>
                
                    <div class='flex mt-8'>
                        <div class="w-full mx-4 " x-show="! menu"
                            x-transition:enter="transition ease-in-out duration-300 transform"
                            x-transition:enter-start="-translate-x-full"
                            x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition ease-in-out duration-300 transform"
                            x-transition:leave-start="translate-x-0"
                            x-transition:leave-end="-translate-x-full">
                            @foreach($tabs as $tab)
                            <section @if(isset($tab['wire_ignore'])) wire:ignore @endif
                            x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                            :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))"
                            role="tabpanel">
                                @if($preview)
                                    <div class="flex justify-between">
                                @endif
                                    <div class="relative w-full mr-4 grid gap-4 @if ($preview) pr-4 border-r border-gray-200 grid-cols-8 @else grid-cols-12 @endif ">
                                        @foreach($tab['inputs'] ?? [] as $input)
                                            @if(isset($input['component']))
                                            @include('walletapp::includes.inputs.'.$input['component'], [
                                                'type' => isset($input['type']) ? $input['type']: null,
                                                'allow_images' => isset($input['allow_images']) ? $input['allow_images']: null,
                                                'placeholder' => isset($input['placeholder']) ? $input['placeholder']: null,
                                                'model' => isset($input['model']) ? $input['model']: null,
                                                'id' => isset($input['id']) ? $input['id']: null,
                                                'label' => isset($input['label']) ? $input['label']: null,
                                                'extra_classes' => isset($input['extra_classes']) ? $input['extra_classes']: null,
                                                'options' => isset($input['options']) ? $input['options']: null,
                                                'call_component_update' => $call_component_update,
                                                'mode' => $mode ?? null,
                                            ])  
                                            @else
                                                @livewire('walletapp::'.$input['custom_component'], [
                                                    'type' => isset($input['type']) ? $input['type']: null,
                                                    'allow_images' => isset($input['allow_images']) ? $input['allow_images']: null,
                                                    'placeholder' => isset($input['placeholder']) ? $input['placeholder']: null,
                                                    'model' => isset($input['model']) ? $input['model']: null,
                                                    'id' => isset($input['id']) ? $input['id']: null,
                                                    'label' => isset($input['label']) ? $input['label']: null,
                                                    'extra_classes' => isset($input['extra_classes']) ? $input['extra_classes']: null,
                                                    'options' => isset($input['options']) ? $input['options']: null,
                                                    'call_component_update' => $call_component_update,
                                                    'mode' => $mode ?? null,
                                                    'multiple' => $input['multiple'] ?? false,
                                                ], key($input['model']))        
                                            @endif                                     
                                        @endforeach
                                    </div>
                                    @if($preview)
                                        <div wire:ignore style="width:500px;">
                                            @if ($preview_component)
                                                @livewire('walletapp::preview', ['mode' => $preview_component])
                                            @else
                                                Define the preview_component to use this feature
                                            @endif
                                        </div>
                                    @endif
                                @if($preview)
                                    </div>
                                @endif
                            </section>
                            @endforeach   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>