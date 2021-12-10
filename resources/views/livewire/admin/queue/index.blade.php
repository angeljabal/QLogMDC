<div class="m-8">
    <div class="flex flex-row-reverse w-full">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
        </a>
    </div>
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-lg inline leading-6 font-extrabold text-gray-700 uppercase text-3xl">Current Serving</h2>
        <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2" wire:poll.keep-alive>
            <!-- Card -->
            @foreach ($current_serving as $current)
            <div class="bg-green-100 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                          {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                          </svg> --}}
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="ml-2 flex-1 block break-words text-3xl font-semibold">
                                {{$current->facility->name}}
                            </dt>
                        </dl>
                    </div>
                    <div class="flex-shrink-0 text-green-500 text-9xl font-extrabold">
                        {{sprintf('%03d', $current->queue_no)}}
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- <div class="mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <h2 class="text-lg inline leading-6 font-extrabold text-gray-900 uppercase text-3xl">Queue</h2>
        <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Card -->
            @foreach ($current_serving as $current)
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">

                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-teal-700 truncate text-xl">
                                {{$current->facility->name}}
                            </dt>
                        </dl>
                    </div>
                    <div class="flex-shrink-0 text-teal-500 text-5xl font-extrabold">
                        {{sprintf('%03d', $current->queue_no)}}
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> --}}

</div>