<div class="m-8">
    <div class="flex flex-row-reverse w-full">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
        </a>
    </div>
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="inline leading-6 font-extrabold text-gray-700 uppercase text-3xl">Current Serving</h2>
        <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2" wire:poll.5000ms.visible>
            @foreach ($current_serving as $current)
            <div class="bg-green-100 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="ml-2 flex-1 block break-words md:text-3xl text-s font-semibold">
                                {{$current->facility->name}}
                            </dt>
                            <dt class="ml-2 flex-1 block break-words md:text-xl text-xs font-semibold">
                                (Window {{$current->window}})
                            </dt>
                        </dl>
                    </div>
                    <div class="flex-shrink-0 text-green-500 lg:text-9xl text-7xl font-extrabold">
                        {{sprintf('%03d', $current->queue_no)}}
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>