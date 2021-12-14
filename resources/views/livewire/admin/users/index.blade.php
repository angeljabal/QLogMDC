<div>
    <x-status.success :success="session('message')"></x-status.success>
    <x-status.deleted :deleted="session('deleted')"></x-status.deleted>
    <div>
        <!-- Users table (small breakpoint and up) -->
        <div class="sm:block">
            <div class="max-w-6xl mx-auto px-4 lg:px-8">
                <div class="rounded-t mb-0 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-2xl text-gray-900">List of Users</h3>
                        </div>
                        <div class="my-2 flex flex-row">
                            <div class="flex flex-row mb-1 sm:mb-0">
                                <div class="relative">
                                    <select wire:model.lazy="perPage"
                                        class="h-full rounded-l border block appearance-none w-full bg-white border-gray-200  text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
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
                                        class="capitalize h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-200  text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
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
                                        class="h-full border block appearance-none w-full bg-white border-gray-200  text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
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
                            <a href="{{ route('admin.users.create') }}" class="ml-3 hidden md:inline-flex items-center px-4 py-2 bg-teal-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 active:bg-teal-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150'">
                                Create User
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col mt-2">
                    <div class="align-middle sm:min-w-full shadow sm:rounded-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="md:pl-10 pl-6 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider md:block hidden">
                                        Address
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="bg-white">
                                        <td class="md:pl-10 pl-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <p class="text-gray-900 font-semibold truncate">
                                                {{$user->name}}
                                            </p>
                                        </td>
                                        <td class="px-4 py-4 text-right whitespace-nowrap text-sm text-gray-500 md:block hidden">
                                            <p class="text-gray-900 font-medium truncate">{{$user->profile->address}}</p>
                                        </td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="{{ route('admin.users.show', ['user'=>$user->id]) }}" title="View">
                                                <svg class="h-7 w-7 p-1 inline-block bg-yellow-500 text-white hover:bg-yellow-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.users.edit', ['user'=>$user->id]) }}" title="Edit">
                                                <svg class="h-7 w-7 p-1 inline-block bg-cyan-500 text-white hover:bg-cyan-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <button wire:click="confirmUserDeletion({{$user->id}})" title="Delete">
                                                <svg class="h-7 w-7 p-1 inline-block bg-red-500 text-white hover:bg-red-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button wire:click="alertConfirm({{$user->id}})" title="Login As">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 p-1 inline-block bg-teal-500 text-white hover:bg-teal-400 hover:text-cyan-700 rounded-md" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6" aria-label="Pagination">
                                {{ $users->links() }}
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


    @push('js')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            window.addEventListener('swal:confirm', event => { 
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                buttons: true,
                dangerMode: true,
            })
            .then((willLogin) => {
            if (willLogin) {
                window.livewire.emit('login');
            }
            });
            });
        </script>
    @endpush
</div>
