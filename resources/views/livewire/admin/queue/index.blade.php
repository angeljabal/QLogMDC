<div class="m-8">
    {{-- <div class="flex flex-row-reverse w-full">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
        </a>
    </div> --}}
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2" wire:poll.5000ms.visible>
            <div class="border-r-2 pr-2">
                <h2 class="inline leading-6 font-extrabold text-gray-700 uppercase text-5xl pb-5">On queue</h2>
                <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($on_queue as $queue)
                    <div class="bg-cyan-100 overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                            <div class="ml-2 w-0 flex-1">
                                <dl>
                                    <dt class="flex-1 block break-words text-base font-semibold">
                                        {{$queue->office->name}}
                                    </dt>
                                </dl>
                            </div>
                            <div class="flex-shrink-0 text-cyan-500 text-5xl font-extrabold">
                                {{sprintf('%03d', $queue->queue_no)}}
                            </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <h2 class="inline leading-6 font-extrabold text-gray-700 uppercase text-5xl pb-5">Current Serving</h2>
                <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">
                @foreach ($current_serving as $current)
                <div class="bg-green-100 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="ml-2 w-0 flex-1">
                            <dl>
                                <dt class="ml-2 flex-1 block break-words text-xl font-extrabold">
                                    {{$current->office->name}}
                                </dt>
                                <dt class="ml-2 flex-1 block break-words md:text-xl text-xs font-semibold">
                                    (Window {{$current->window}})
                                </dt>
                            </dl>
                        </div>
                        <div class="flex-shrink-0 text-green-500 text-7xl font-extrabold">
                            {{sprintf('%03d', $current->queue_no)}}
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>


        </div>
    </div>
</div>