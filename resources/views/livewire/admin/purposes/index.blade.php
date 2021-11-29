<div>
    <x-status.success :success="session('message')"></x-status.success>
    <x-status.deleted :deleted="session('deleted')"></x-status.deleted>
    <div>
        <!-- Users table (small breakpoint and up) -->
        <div class="hidden sm:block">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8  m-5">
                {{-- <div class="flex flex-row-reverse w-full">
                    <div class="">
                        <x-buttons.button class="max-w-6xl mx-auto my-2 px-4" wire:click="confirmPurposeAdd()">
                            {{ __('Add purpose') }}
                        </x-buttons.button>
                    </div>
                </div> --}}
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <div class="block relative">
                            <select wire:model.lazy="facility"
                                    class="appearance-none  h-full rounded-md border block rounded w-full bg-white text-gray-700 py-2 px-5 pr-8 leading-tight focus:outline-none focus:bg-white">
                                    <option value="0">All</option>
                                    @foreach ($facilities as $faci)
                                        <option value="{{$faci->id}}">{{$faci->name}}</option>
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
                    <div>
                        <div class="block relative">
                            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                    <path
                                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                    </path>
                                </svg>
                            </span>
                            <input wire:model.lazy="search" placeholder="Search"
                                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-200  border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white  focus:text-gray-700 focus:outline-none" 
                                type="search"/>
                        </div>
                    </div>
                    <div class="col-end-6">
                        <x-buttons.button wire:click="addPurpose()">
                            {{ __('Add purpose') }}
                        </x-buttons.button>
                    </div>
                    {{-- <div class="my-2 flex sm:flex-row flex-col">
                        <div class="block relative">
                            <select wire:model.lazy="facility"
                                    class="appearance-none  h-full rounded-md border block rounded w-full bg-white text-gray-700 py-2 px-5 pr-8 leading-tight focus:outline-none focus:bg-white">
                                    <option value="0">All</option>
                                    @foreach ($facilities as $faci)
                                    <option value="{{$faci->id}}">{{$faci->name}}</option>
                                    @endforeach
                            </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                        </div>
                    </div> --}}
                </div>
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Purposes
                                    </th>
                                    <th class="hidden px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider md:block">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($purposes as $purpose)
                                    <tr class="bg-white">
                                        <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div  x-data="{selected:null}">
                                            {{-- <a href="{{ route('admin.users.show', ['user'=>$profile->user->id]) }}" class="group inline-flex space-x-2 truncate text-sm"> --}}
                                                <button @click="selected !== 0 ? selected = 0 : selected = null" class="text-gray-500 font-bold truncate group-hover:text-gray-900">
                                                    {{$purpose->title}}
                                                </button>
                                                <div x-show="selected == 0" class="py-2 px-2">
                                                    @if ($purpose->facilities->contains($purpose->id))
                                                        @foreach ($purpose->facilities as $facility)
                                                            <li>{{$facility->name}}</li>
                                                        @endforeach
                                                    @else
                                                    <p class="mt-1 max-w-2xl text-xs font-thin">
                                                        No facilities added yet.
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                            <a href="{{ route('admin.purposes.edit', ['purpose'=>$purpose->id]) }}">
                                                <svg class="h-7 w-7 p-1 inline-block bg-teal-500 text-white hover:bg-teal-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <button wire:click="confirmPurposeDeletion({{$purpose->id}})">
                                                <svg class="h-7 w-7 p-1 inline-block bg-red-500 text-white hover:bg-red-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <nav class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6" aria-label="Pagination">
                                {{ $purposes->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-modals.confirmation wire:model="confirmingPurposeDeletion">
        <x-slot name="title">
            {{ __('Delete Purpose - ' . $title) }}
        </x-slot>
 
        <x-slot name="content">
            {{ __('Are you sure you want to delete this purpose? ') }}
        </x-slot>
 
        <x-slot name="footer">
            <x-buttons.secondary wire:click="back()" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-buttons.secondary>
 
            <button class="px-4 py-2 text-sm rounded-md text-white bg-red-500 text-white hover:bg-red-700" wire:click="deletePurpose()" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </button>
        </x-slot>
    </x-modals.confirmation>

</div>
