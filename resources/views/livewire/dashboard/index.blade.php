<div>
    <div class="bg-white shadow">
        <input type="hidden">
        <div class="px-4 sm:px-6 lg:max-w-full lg:mx-auto lg:px-8">
        <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
            <div class="flex-1 min-w-0">
                <!-- Profile -->
                <div class="flex items-center">
                    <div>
                    <div class="flex items-center">
                        <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                            {{auth()->user()->fname . ' ' . auth()->user()->lname}}
                        </h1>
                    </div>
                    <dl class="ml-2 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                        <div class="flex items-center">
                        @if (auth()->user()->hasRole('admin'))
                        <dd class="mt-2 flex items-center text-xs md:text-sm font-medium sm:mr-6 sm:mt-0 capitalize text-green-500 md:-mt-1">
                              <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                              </svg>
                            {{auth()->user()->hasRole('admin') ? 'Admin' : 'Facility Head'}}
                        </dd>
                        @endif
                        <dd class="mt-2 flex items-center text-xs md:text-sm text-gray-500 font-medium capitalize sm:mr-6 md:-mt-1 ml-2">
                            <!-- Heroicon name: solid/office-building -->
                            {{isset(auth()->user()->facility->name) ? auth()->user()->facility->name : ''}}
                        </dd>
                        </div>
                    </dl>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                <a href="{{auth()->user()->hasRole('head') ? url('/facility') : url('/logs')}}" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                {{auth()->user()->hasRole('head') ? 'View Facility' : 'Checkout logs'}}
                </a>
                <a href="{{url('generate-qrcode', ['user'=>auth()->user()->id])}}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                Generate QRCode
                </a>
            </div>
        </div>
        </div>
    </div>
    <div class="mt-8">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            @if(auth()->user()->hasRole('admin') || isset(auth()->user()->facility))
                <livewire:admin.dashboard.partials.range/>
            @else
                <div>
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-lg text-gray-900">Overview</h3>
                            <h2 class="text-xs inline leading-6 text-gray-500">({{\Carbon\Carbon::today()->format('M d, Y')}})</h2>
                        </div>
                    </div>
                </div>
            @endif

            <!-- HEAD OVERVIEW-->
            @if(auth()->user()->hasRole('office-head') && isset(auth()->user()->office))
                <livewire:admin.dashboard.head/>

            <!-- ADMIN OVERVIEW-->
            @elseif (auth()->user()->hasRole('admin'))
                <livewire:admin.dashboard.admin/>
            @else
                <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <!-- Heroicon name: outline/scale -->
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Facilities Visits
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                        {{$count}}
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-teal-700 truncate">
                                        Total Facilities Available
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                        {{$facilitiesAvailable}}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                            <a href="{{url('/facilities')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                            View all
                            </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        </div>
        @if (isset($logs) && $logs->count()!=0 && !auth()->user()->hasRole('admin'))
            <h2 class="mx-auto mt-8 md:px-10 px-5 text-lg leading-6 font-medium text-gray-900">
                Recent activity
            </h2>
            <!-- Activity table (small breakpoint and up) -->
            <div class="sm:block">
                <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col mt-2">
                        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Purpose
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Facility Visited
                                        </th>
                                        <th class="hidden px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider md:block">
                                            Time In
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($logs as $log)
                                        <tr class="bg-white">
                                                
                                            <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex">
                                                <a href="#" class="group inline-flex space-x-2 truncate text-sm">
                                                    <!-- Heroicon name: solid/cash -->
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <p class="text-gray-500 truncate group-hover:text-gray-900">
                                                        {{$log->purpose}}
                                                    </p>
                                                </a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                                <span class="text-gray-900 font-medium">
                                                    {{$log->facility != null ? $log->facility->name : ''}}
                                                </span>
                                            </td>
                                            <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                                    {{$log->created_at->format('g:i A')}}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                                <time datetime="2020-07-11">{{$log->created_at->format('M d, Y')}}</time>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- More transactions... -->
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <nav class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6" aria-label="Pagination">
                                    {{ $logs->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
