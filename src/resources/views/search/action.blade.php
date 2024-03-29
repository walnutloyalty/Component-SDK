<div
    class="hidden w-1/2 flex-none flex-col @if (!is_null($user)) divide-y divide-gray-100 @else text-center @endif overflow-y-auto sm:flex">
    @if (isset($user['email']))
        <div class="flex-none p-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto text-gray-500 h-16 w-16 rounded-full" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <h2 class="mt-3 font-semibold text-gray-900">{{ $user['full_name'] }}</h2>
            <p class="text-sm leading-6 text-gray-500">{{ $user['email'] }}</p>
        </div>
        <div class="flex flex-auto flex-col justify-between p-6">
            <dl class="grid grid-cols-1 gap-x-6 gap-y-3 text-sm text-gray-700">
                <dt class="col-end-1 font-semibold text-gray-900">Phone</dt>
                <dd class="text-xs mt-1 truncate text-sky-600">{{ $user['phone_number'] ?? 'Not provided' }}</dd>
                <dt class="col-end-1 font-semibold text-gray-900">Birthday</dt>
                <dd class="text-xs mt-1 truncate text-sky-600">{{ $user['birth_day'] ?? 'Not provided' }}</dd>
                <dt class="col-end-1 font-semibold text-gray-900">Member</dt>
                <dd class="text-xs mt-1 truncate text-sky-600">{{ $user['identifier'] ?? 'Not provided' }}</dd>
            </dl>
            <div class="grid grid-cols-6 gap-3 mt-6">
                <a @if (!auth()->user()->tokenCan('member_info')) href="#" x-data x-tooltip="You dont have access"
                @else
                x-data
                x-tooltip="View profile"
                data-tippy-arrow="false"
                href="{{ route('member.profile.page', ['uuid' => $user['identifier'], 'search_type' => $user['id'], 'tab' => 'overview']) }}" @endif
                    class="rounded-lg inline-flex p-3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 bg-sky-600 text-white hover:bg-sky-700">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                      </svg>                      
                </a>
                <a @if (!auth()->user()->tokenCan('member_info')) href="#" x-data x-tooltip="You dont have access"
                @else
                x-data
                x-tooltip="View passes"
                href="{{ route('member.profile.page', ['uuid' => $user['identifier'], 'search_type' => $user['id'], 'tab' => 'rewards']) }}" @endif
                    @click="type ='overview'" x-data="" x-tooltip="Overview" data-tippy-arrow="false"
                    class="rounded-lg inline-flex p-3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 bg-sky-600 text-white hover:bg-sky-700">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                        <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
                      </svg>                      
                </a>
            </div>
        </div>
    @elseif(!is_null($user))
        <div class="my-auto ">
            <div class="flex-none p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto text-gray-500 h-16 w-16 rounded-full"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="mt-3 font-semibold text-gray-900">Do a search</h2>
                <p class="text-sm leading-6 text-gray-500">If we find anyone we will display it here</p>
            </div>
            <div class="flex flex-auto flex-col justify-between p-6">
                <dl class="grid grid-cols-1 gap-x-6 gap-y-3 text-sm text-gray-700">
                    <dt class="col-end-1 font-semibold text-gray-900">Email</dt>
                    <dd class="text-xs mt-1 truncate text-sky-600">We will display the member</dd>
                    <dt class="col-end-1 font-semibold text-gray-900">Webshop</dt>
                    <dd class="text-xs mt-1 truncate text-sky-600">Products will be shown below</dd>
                    <dt class="col-end-1 font-semibold text-gray-900">Passes</dt>
                    <dd class="text-xs mt-1 truncate text-sky-600">The associated member will be shown</dd>
                </dl>
                <button type="button" wire:click="$emit('lookup')"
                    class="mt-6 w-full rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">Let's
                    search!</button>
            </div>
        </div>
        <!-- Heroicon name: outline/users -->
    @else
        <div class="flex-none p-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto text-gray-500 h-16 w-16 rounded-full" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="mt-3 font-semibold text-gray-900">No members found</h2>
            <p class="text-sm leading-6 text-gray-500">Seems like this search doesn't have results</p>
        </div>
        <div class="flex flex-auto flex-col justify-between p-6">
            <button type="button" wire:click="$emit('lookup')"
                class="mt-6 w-full rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">Again</button>
        </div>
    @endif

</div>
