
<div @openfirst.window="step = 'showform'" @csvdone.window="step = 'showdone'" @selectheaders.window="step = 'setheaders'" @csverror.window="showError = true; setTimeout(() => { showError = false; }, 5000);" x-data="{step:'showform', showError: false}" x-transition class="bg-white overflow-hidden shadow rounded-lg">
<div x-show="showError" class="bg-red-600">
    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between flex-wrap">
        <div class="w-0 flex-1 flex items-center">
          <p class="ml-3 font-medium text-white truncate">
            <span class="md:hidden"> {{$message}} </span>
            <span class="hidden md:inline"> {{$message}} </span>
          </p>
        </div>
      </div>
    </div>
  </div>
  
    <div class="px-4 py-5 sm:p-6">
        <div x-show="step === 'showform'" style="margin:0;" class=" gap-4 @if($type === 'hidden') hidden @endif {{$extra_classes ?? ''}}">
            <span class="text-gray-700 text-sm">{{$label}}</span>
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
                <input id="{{$id ?? 'input'}}" type="file"  wire:model="csv_import"
                       class="h-full w-full opacity-0" name="">
                       
                   
            </div>
            <div class="flex justify-between items-center text-gray-500"><span>Accepted
                    file type: .csv,
                    .xls</span> <span class="flex items-center "><i
                            class="fa fa-lock mr-1"></i> secure</span></div>
                            @error('csv_import') <span
                         
                class="mt-1 text-red-500">{{ $message }}</span> @enderror
        </div>
        <div x-show="step === 'setheaders'">
            <span class="text-gray-700 text-sm">Pick the headers from your import</span>
            @foreach ($headers as $key => $header) 
                <label for="{{$header}}" class="mt-4 block text-xs text-gray-700">{{$header}}</label>
                <select id="{{$header}}" wire:model="selected_headers.{{$key}}" name="{{$header}}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md">
                    <option>Select an option</option>
                    @foreach ($pickable_headers as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            @endforeach
        </div>
        <div x-show="step === 'showdone'">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-500 h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-center text-gray-500 mt-4">
                Csv has been processed
            </p>
            <button type="button" wire:click="tryAgain" class="w-full text-center inline-flex items-center px-4 py-2 border border-transparent text-base font-medium mt-4 rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"> <span class="mx-auto">Try again</span></button>

        </div>

    </div>
    <div x-show="step === 'setheaders'" class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <button wire:click="validateHeaders" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">Next</button>
      </div>
</div>
  