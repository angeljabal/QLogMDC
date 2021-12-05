<div>
    <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: outline/scale -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-yellow-600 truncate">
                            Waiting
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">
                            {{-- {{$waiting}} --}}
                            </div>
                        </dd>
                    </dl>
                </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                <a href="{{url('/queue')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                View all
                </a>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-teal-500 truncate">
                            Completed
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">
                            {{-- {{$completed}} --}}
                            </div>
                        </dd>
                    </dl>
                </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                <a href="{{url('/logs')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                View all
                </a>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: outline/scale -->
                    <svg class="h-6 w-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-cyan-600 truncate">
                            Walk-ins
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">
                            {{-- {{$transactions}} --}}
                            </div>
                        </dd>
                    </dl>
                </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                <a href="{{url('/facility')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                View all
                </a>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: outline/scale -->
                    <svg class="h-6 w-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-cyan-600 truncate">
                            Facilities Available
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">
                            {{-- {{$transactions}} --}}
                            </div>
                        </dd>
                    </dl>
                </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                <a href="{{url('/facility')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                View all
                </a>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: outline/scale -->
                    <svg class="h-6 w-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-cyan-600 truncate">
                            Total Transactions
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">
                            {{-- {{$transactions}} --}}
                            </div>
                        </dd>
                    </dl>
                </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                <a href="{{url('/facility')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                View all
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
