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
        <input multiple id="{{$id ?? 'input'}}" type="file"  wire:model.lazy="{{$model}}"
               class="h-full w-full opacity-0" name="">
               
           
    </div>
    <div class="flex justify-between items-center text-gray-500"><span>Accepted
            file type: .jpg,
            .jpeg, .png, .webp</span> <span class="flex items-center "><i
                    class="fa fa-lock mr-1"></i> secure</span></div>
                    @error($model) <span
                 
        class="mt-1 text-red-500">{{ $message }}</span> @enderror
    @if(isset($multi_previews[$model]))
    <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-5">
        <div class="flex overflow-hidden -space-x-1">
            @foreach($multi_previews[$model] as $key => $image)
                <img wire:click="removeImage('{{$model}}', {{$key}})" class="inline-block h-12 w-12 hover:cursor-pointer rounded-full ring-2 ring-white" src="{{$image}}" x-tooltip="Click to remove" alt="Dries Vincent">
            @endforeach
       </div>
    </div>
    @endif
</div>
