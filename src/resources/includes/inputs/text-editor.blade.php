
<div  wire:ignore style="margin:0;" class="@if($type === 'hidden') hidden @endif {{$extra_classes ?? ''}}"
    x-data="{
        value: '',
        init() {
            let quill = new Quill(this.$refs.quill, { theme: 'snow' })
 
            quill.root.innerHTML = this.value
 
            quill.on('text-change', () => {
                this.value = quill.root.innerHTML
                @this.set('{{$model}}', quill.root.innerHTML)
            })
        },
    }">
    <label for="{{$id ?? 'input'}}" class=" block text-sm font-medium text-gray-700">{{$label ?? 'input'}}</label>
    <div x-ref="quill"></div>
</div>