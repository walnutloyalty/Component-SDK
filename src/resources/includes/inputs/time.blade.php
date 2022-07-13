<div wire:ingore style="margin:0;" class="@if($type === 'hidden') hidden @endif {{$extra_classes ?? ''}}"
    x-data="{
        value: '', 
        init() {
            let {{$model}}_picker = flatpickr(this.$refs.{{$model}}_picker, {
                mode: 'single',
                dateFormat: 'Y-m-d',
                onChange: (date, dateString) => {
                    @this.set('{{$model}}', dateString)
                    @this.componentUpdated('{{$model}}')
                    this.value = dateString.split(' to ')
                }
            })
 
            this.$watch('value', () => { 
                {{$model}}_picker.setDate(this.value) 
            })
        },
    }"
    class="max-w-sm mx-auto"
>
    <label for="{{$id ?? 'input'}}" class=" block text-sm font-medium text-gray-700">{{$label ?? 'input'}}</label>
 
    <input wire:model.lazy="{{$model}}" class=" shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" x-ref="{{$model}}_picker" type="text">
</div>