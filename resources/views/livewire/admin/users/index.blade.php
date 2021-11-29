<div>
    <x-status.success :success="session('message')"></x-status.success>
    <x-status.deleted :deleted="session('deleted')"></x-status.deleted>
    <div>
        <!-- Users table (small breakpoint and up) -->
        <div class="hidden sm:block">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-t mb-0 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-lg text-base text-gray-900">List of Users</h3>
                        </div>
                        <div class="my-2 flex sm:flex-row flex-col">
                            <div class="flex flex-row mb-1 sm:mb-0 ">
                                <div class="relative">
                                    <select wire:model.lazy="perPage"
                                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-200  text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>20</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="relative">
                                    <select wire:model.lazy="role"
                                        class="appearance-none capitalize h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-200  text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
                                        <option value="all">All</option>
                                        @foreach ($roles as $r)
                                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="relative">
                                    <select wire:model.lazy="type"
                                        class="appearance-none h-full border block appearance-none w-full bg-white border-gray-200  text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
                                        <option value="all">All</option>
                                        @foreach ($types as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="block relative">
                                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                        <path
                                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                        </path>
                                    </svg>
                                </span>
                                <input placeholder="Search" wire:model.lazy="search"
                                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-200  border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white  focus:text-gray-700 focus:outline-none" 
                                    type="search"/>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="flex justify-between w-full">
                    
                    <div class="inline">
                        <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                            List of Users
                        </h2>
                    </div>
                    
                    <div class="flex items-center text-center">
                        <form class="w-full flex md:ml-0" action="#" method="GET">
                            <label for="search-field" class="sr-only">Search</label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none p-1" aria-hidden="true">
                                    <!-- Heroicon name: solid/search -->
                                    <svg class="h-5 w-5 p-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.lazy="search" id="search-field" name="search-field"
                                    class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm"
                                    placeholder="Search" type="search">
                            </div>
                        </form>
                    </div>
                </div> --}}
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-y-auto shadow overflow-hidden sm:rounded-sm">
                        <table class="min-w-full divide-y divide-gray-200 overflow-auto">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Address
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Phone Number
                                    </th>
                                    <th class="hidden px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider md:block">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="bg-white">
                                        <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex">
                                            {{-- <a href="{{ route('admin.users.show', ['user'=>$user->user->id]) }}" class="group inline-flex space-x-2 truncate text-sm"> --}}
                                                <p class="text-gray-500 font-bold truncate group-hover:text-gray-900">
                                                    {{$user->name}}
                                                </p>
                                            {{-- </a> --}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                            <span class="text-gray-900 font-medium">{{$user->profile->address}}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="text-gray-900 font-medium">
                                            {{$user->profile->phone_number}}
                                            </span>
                                        </td>
                                        <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                            <a href="{{ route('admin.users.show', ['user'=>$user->id]) }}">
                                                <svg class="h-7 w-7 p-1 inline-block bg-yellow-500 text-white hover:bg-yellow-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.users.edit', ['user'=>$user->id]) }}">
                                                <svg class="h-7 w-7 p-1 inline-block bg-teal-500 text-white hover:bg-teal-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <button wire:click="confirmUserDeletion({{$user->id}})">
                                                <svg class="h-7 w-7 p-1 inline-block bg-red-500 text-white hover:bg-red-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            {{-- <a href="{{ route('admin.users.show', ['user'=>$user->user->id]) }}" class="button p-4 m-1 text-sm text-white bg-cyan-600 rounded-md">Edit</a> --}}
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- More transactions... -->
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <nav class="bg-white px-4 py-3 border-t border-gray-200  sm:px-6" aria-label="Pagination">
                            {{-- <div class="flex-1 flex justify-between sm:justify-end"> --}}
                                {{ $users->links() }}
                            {{-- </div> --}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modals.confirmation wire:model="confirmingUserDeletion">
        <x-slot name="title">
            {{ __('Delete User - ' . $name) }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this user? ') }}
        </x-slot>

        <x-slot name="footer">
            <x-buttons.secondary class="p-4 m-1 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-700" x-on:click="show = false"  wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-buttons.secondary>

            <button class="px-4 py-2 text-sm rounded-md bg-red-500 text-white hover:bg-red-700" wire:click="deleteUser()" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </button>
        </x-slot>
    </x-modals.confirmation>
</div>
