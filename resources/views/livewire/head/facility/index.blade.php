<div>
    <div class="px-10 bg-white shadow">
        <div class="px-4 sm:px-6 lg:max-w-full lg:mx-auto lg:px-8">
            <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
                <div class="flex-1 min-w-0">
                    <!-- Profile -->
                    <div class="flex items-center">
                        <div>
                            <div class="flex items-center">
                                <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                                    {{auth()->user()->facility->name . " (" . auth()->user()->facility->code . ")"}}
                                </h1>
                            </div>
                            <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                                <dd class="mt-3 flex items-center text-sm text-gray-500 font-medium sm:mr-6 sm:mt-0 capitalize">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                    </svg>
                                {{auth()->user()->name}}
                                </dd>
                                <dd class="mt-3 flex items-center text-sm text-gray-500 font-medium sm:mr-6 sm:mt-0 capitalize">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Total Windows: {{auth()->user()->facility->windowsAvailable}}
                                </dd>
                                <dd wire:model.lazy="isOpen" class="{{$isOpen ? 'text-teal-500' : 'text-red-600'}} mt-3 flex items-center text-sm  font-medium sm:mr-6 sm:mt-0 uppercase">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 " viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                                    </svg>
                                    {{$isOpen ? 'OPEN' : 'CLOSED'}}
                                </dd>

                            </dl>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                    <button wire:click="confirmWindowsEdit()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                        Edit Total Windows
                    </button>
                    <button wire:click="changeStatus()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                        Change Status
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:block">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-20">
            <div class="grid grid-cols-4 gap-4 mt-5">
                <div>
                    <h2 class="max-w-6xl mx-auto mt-4 text-2xl leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                        Logs
                    </h2>
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
                <div class="align-middle min-w-full overflow-x-auto shadow overflow- sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Purpose
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:block">
                                Name
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Time
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($logs as $log)
                            <tr class="bg-white">
                                <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900 truncate">
                                    <span class="text-gray-500 truncate group-hover:text-gray-900">
                                        {{$log->purpose}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500 hidden md:block">
                                    <span class="text-gray-900 font-medium">
                                        {{$log->user->name}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="text-gray-900 text-xs text-center">
                                        {{\Carbon\Carbon::parse($log->created_at)->format('g:i A')}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center text-xs font-medium capitalize">
                                        {{\Carbon\Carbon::parse($log->created_at)->format('d/m/Y')}}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
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

    <x-modals.add wire:model="confirmingWindowsEdit" wire:keydown.escape="$set('confirmingWindowsEdit', false)">
        <x-slot name="title">
            Edit Total Windows
        </x-slot>
 
        <x-slot name="content">
            <div>
                <x-label for="name" value="{{ __('Total Windows') }}" />
                <x-input id="windowsAvailable" type="number" class="mt-1 block w-full" value="windowsAvailable" wire:model.defer="windowsAvailable" autofocus/>
                @error('windowsAvailable') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
            </div>
        </x-slot>
 
        <x-slot name="footer">
            <x-buttons.secondary wire:click="$set('confirmingWindowsEdit', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-buttons.secondary>
            <x-buttons.button wire:click="save()" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-buttons.button>
        </x-slot>
    </x-modals.add>
</div>