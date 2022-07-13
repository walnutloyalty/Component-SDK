
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
    <svg x-tooltip="{{$tooltip ?? 'tooltip'}}" class="z-10 absolute text-gray-500 top-4 right-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <ul wire:ignore  x-ref="tablist"
        x-cloak
        @keydown.right.prevent.stop="$focus.wrap().next()"
        @keydown.home.prevent.stop="$focus.first()"
        @keydown.page-up.prevent.stop="$focus.first()"
        @keydown.left.prevent.stop="$focus.wrap().prev()"
        @keydown.end.prevent.stop="$focus.last()"
        @keydown.page-down.prevent.stop="$focus.last()" class="relative -mb-px flex space-x-2" aria-label="Tabs">
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
    <div class="flex w-full"
        x-transition:enter="opacity-0 transition ease-in-out duration-500 transform"
        x-transition:enter-start="opacity-0 -translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="opacity-100 transition ease-in-out duration-500 transform"
        x-transition:leave-start="opacity-0 translate-x-0"
        x-transition:leave-end="opacity-0 -translate-x-full">
        @if($type === 'area')
            @foreach($tabs as $tab)
                <section class='min-w-full'
                x-transition:enter.duration.600ms
                x-transition:leave.duration.600ms
                x-transition.opacity
                x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))"
                role="tabpanel"
                    x-data="{
                        values:  @json($tab),
                        labels: {!! str_replace('"', "'", json_encode($labels))!!},
                        init() {
                            let chart = new ApexCharts(this.$refs.chart, this.options)
                    
                            chart.render()
                        
                            this.$watch('values', () => {
                                chart.updateOptions(this.options)
                            })
                        },
                        get options() {
                            return {
                                chart: { type: 'area', toolbar: false },
                                color: '#00d0ff',
                                stacked: true,
                                dataLabels: {
                                    enabled: false
                                },
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                    shade: 'dark',
                                    type: 'vertical',
                                    shadeIntensity: 1,
                                    gradientToColors: ['#00d0ff', '#65c5fc', '#bee4fa'], // optional, if not defined - uses the shades of same color in series
                                    inverseColors: false,
                                    opacityFrom: 0.2,
                                    opacityTo: 0.6,
                                    stops: [0, 90, 100],
                                    colorStops: []
                                    }
                                },
                                tooltip: {
                                    marker: false,
                                    y: {
                                        formatter(number) {
                                            return '$'+number
                                        }
                                    }
                                },
                                xaxis: { categories: this.labels },
                                series: [{
                                    name: 'Sales',
                                    data: this.values,
                                }],
                            }
                        }
                    }">
                    <div x-ref="chart" class="bg-white rounded-lg"></div>
                </section>
            @endforeach   
        @else
        <section class='min-w-full'
            x-transition:enter.duration.600ms
            x-transition:leave.duration.600ms
            x-transition.opacity
            x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
            :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))"
            role="tabpanel"
                x-data="{
                    values:  @json($data),
                    labels: {!! str_replace('"', "'", json_encode($labels))!!},
                    init() {
                        let chart = new ApexCharts(this.$refs.chart, this.options)
                
                        chart.render()
                    
                        this.$watch('values', () => {
                            chart.updateOptions(this.options)
                        })
                    },
                    get options() {
                        return {
                            chart: { type: 'bar',  toolbar: false },
                            color: '#00d0ff',
                            stacked: true,
                            dataLabels: {
                                enabled: false
                            },
                            fill: {
                                type: 'gradient',
                                gradient: {
                                shade: 'dark',
                                type: 'vertical',
                                shadeIntensity: 1,
                                gradientToColors: ['#00d0ff', '#65c5fc', '#bee4fa'], // optional, if not defined - uses the shades of same color in series
                                inverseColors: false,
                                opacityFrom: 1,
                                opacityTo: 0.6,
                                stops: [0, 90, 100],
                                colorStops: []
                                }
                            },
                            tooltip: {
                                marker: false,
                                y: {
                                    formatter(number) {
                                        return '$'+number
                                    }
                                }
                            },
                            xaxis: { categories: this.labels },
                            series: [{
                                name: 'Sales',
                                data: this.values,
                            }],
                        }
                    }
                }">
            <p style="padding-bottom: .9rem" class="px-4 pt-4 font-medium border-b border-gray-200 text-gray-500">{{$title}}</p>
            <div x-ref="chart" style="height:100% !important;" class="bg-white rounded-lg"></div>
        </section>
        @endif
  
    </div>
 </div>