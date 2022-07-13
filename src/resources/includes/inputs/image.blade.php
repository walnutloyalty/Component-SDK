<div style="margin:0;" class=" gap-4 @if($type === 'hidden') hidden @endif {{$extra_classes ?? ''}}">
        <span>{{$label}}</span>
        <div class="relative mt-1 h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
            <div class="absolute">
                <div class="flex flex-col items-center"><i
                            class="fa fa-cloud-upload fa-3x text-gray-300"></i>
                    <span
                            class="block text-gray-500 font-normal">attach your files
                        here</span>
                    <span class="block text-gray-500 font-normal">or</span> <span
                            class="block text-blue-500 font-normal">Browse
                        files</span></div>
            </div>
            <input id="{{$id ?? 'input'}}" type="file"  @if(isset($call_component_update) && $call_component_update) wire:change="componentUpdated('{{$model}}')" @endif  wire:model.lazy="{{$model.'_url'}}"
                   class="h-full w-full opacity-0" name="">
                   
               
        </div>
        <div class="flex justify-between items-center text-gray-500"><span>Accepted
                file type: .jpg,
                .jpeg, .png, .webp</span> <span class="flex items-center "><i
                        class="fa fa-lock mr-1"></i> secure</span></div>
                        @error($model) <span
                     
            class="mt-1 text-red-500">{{ $message }}</span> @enderror
</div>
