<div>
    {{-- Update success message. --}}
    @if(session()->has('message'))
    <div class="px-4 py-5 sm:px-6">
      <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
            <p class="font-bold">{{session('message')}}</p>
          </div>
        </div>
      </div>
    </div>
    @endif

    {{-- Delete success message. --}}
    @if(session()->has('deleted'))
    <div class="px-4 py-5 sm:px-6">
      <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
            <p class="font-bold">{{session('deleted')}}</p>
          </div>
        </div>
      </div>
    </div>
    @endif
    
    <div class="mt-8">
        <!-- Users table (small breakpoint and up) -->
        <div class="hidden sm:block">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between w-full">
                    <div class="">
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
                    {{-- <div class="flex items-center text-center">
                        <label for="search">Search</label>       
                        <input wire:model.lazy="search" type="text" class="ml-2 text-sm p-4">
                    </div> --}}
                </div>
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
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
                                @foreach ($profiles as $profile)
                                    <tr class="bg-white">
                                        <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex">
                                            {{-- <a href="{{ route('admin.users.show', ['user'=>$profile->user->id]) }}" class="group inline-flex space-x-2 truncate text-sm"> --}}
                                                <p class="text-gray-500 font-bold truncate group-hover:text-gray-900">
                                                    {{$profile->user->name}}
                                                </p>
                                            {{-- </a> --}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                            <span class="text-gray-900 font-medium">{{$profile->address}}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="text-gray-900 font-medium">
                                            {{$profile->phone_number}}
                                            </span>
                                        </td>
                                        <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                            <a href="{{ route('admin.users.show', ['user'=>$profile->user->id]) }}">
                                                <svg class="h-7 w-7 p-1 inline-block bg-yellow-500 text-white hover:bg-yellow-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.users.edit', ['user'=>$profile->user->id]) }}">
                                                <svg class="h-7 w-7 p-1 inline-block bg-teal-500 text-white hover:bg-teal-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <button wire:click="confirmUserDeletion({{$profile->user->id}})">
                                                <svg class="h-7 w-7 p-1 inline-block bg-red-500 text-white hover:bg-red-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            {{-- <a href="{{ route('admin.users.show', ['user'=>$profile->user->id]) }}" class="button p-4 m-1 text-sm text-white bg-cyan-600 rounded-md">Edit</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                
                                <!-- More transactions... -->
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <nav class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6" aria-label="Pagination">
                            {{-- <div class="flex-1 flex justify-between sm:justify-end"> --}}
                                {{ $profiles->links() }}
                            {{-- </div> --}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-confirmation-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            {{ __('Delete User - ' . $name) }}
        </x-slot>
 
        <x-slot name="content">
            {{ __('Are you sure you want to delete this user? ') }}
        </x-slot>
 
        <x-slot name="footer">
            <x-secondary-button class="p-4 m-1 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-700" wire:click="$set('confirmingUserDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
 
            <button class="p-4 m-1 text-sm rounded-md bg-red-500 text-white hover:bg-red-700" wire:click="deleteUser()" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </button>
        </x-slot>
    </x-confirmation-modal>
</div>
