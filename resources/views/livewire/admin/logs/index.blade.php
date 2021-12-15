<div>
    <div>
        <div class="sm:block">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-4 gap-4 mt-5">
                    <div class="col-span-2">
                        <div class="block relative py-2">
                            <select wire:model.lazy="facility"
                                    class="appearance-none  h-full border block rounded w-full bg-white text-gray-700 py-2 px-5 pr-8 leading-tight focus:outline-none focus:bg-white">
                                    <option value="0">All</option>
                                    @foreach ($facilities as $faci)
                                        <option value="{{$faci->id}}">{{$faci->name}}</option>
                                    @endforeach
                                    <option value="-1">Walk-in</option>
                            </select>
                            <div 
                                class="grid grid-cols-2 pointer-events-none absolute inset-y-0 md:right-1 -right-2 mx-2 items-center px-auto text-gray-700">
                                <svg class="fill-current h-4 w-4 col-end-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div> 
                    </div>
                    <div class="col-end-6">
                        <div class="flex items-center">
                            <livewire:admin.partials.range/>
                            <x-buttons.button wire:click="export()" class="ml-5">
                                {{ __('Export Logs') }}
                            </x-buttons.button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-x-auto overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Purpose
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Facility Visited
                                </th>
                                <th class="hidden px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider md:block">
                                    Time In
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                            {{$log->user->name}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                        <span class="text-gray-900 font-medium">
                                            {{$log->facility != null ? $log->facility->name : ''}}
                                        </span>
                                    </td>
                                    <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                            {{\Carbon\Carbon::parse($log->created_at)->format('g:i A')}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                        {{\Carbon\Carbon::parse($log->created_at)->format('d/m/Y')}}
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
</div>
