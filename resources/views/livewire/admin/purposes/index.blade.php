<div>
    <x-status.success :success="session('message')"></x-status.success>
    <x-status.deleted :deleted="session('deleted')"></x-status.deleted>
    <div>
        <!-- Users table (small breakpoint and up) -->
        <div class="hidden sm:block">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-row-reverse w-full">
                    <div class="">
                        <x-buttons.button class="max-w-6xl mx-auto mt-8 px-4" wire:click="confirmPurposeAdd()">
                            {{ __('Add purpose') }}
                        </x-buttons.button>
                    </div>
                </div>
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Purposes
                                    </th>
                                    {{-- <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Facility
                                    </th> --}}
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
                                                        <li>{{$purpose->facilities}}</li>
                                                    @else
                                                    <p class="mt-1 max-w-2xl text-xs font-thin">
                                                        No facilities added yet.
                                                      </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                            <button wire:click="confirmPurposeEdit({{$purpose->id}})">
                                                <svg class="h-7 w-7 p-1 inline-block bg-teal-500 text-white hover:bg-teal-400 hover:text-cyan-700 rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
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
 
            <button class="px-4 py-2 text-sm rounded-md text-white bg-red-500 text-white hover:bg-red-700" wire:click="deleteUser()" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </button>
        </x-slot>
    </x-modals.confirmation>

    <x-modals.add wire:model="confirmingPurposeAdd" wire:keydown.escape="back()">
        <x-slot name="title">
            {{ isset( $this->purpose->id) ? 'Edit Purpose' : 'Add Purpose'}}
        </x-slot>
 
        <x-slot name="content" x-data="{facility:null}">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" autofocus/>
                @error('title') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
            </div>

            <div  x-data="{facility:null}" class="col-span-6 sm:col-span-4 mt-5">
                {{-- <a href="{{ route('admin.users.show', ['user'=>$profile->user->id]) }}" class="group inline-flex space-x-2 truncate text-sm"> --}}
                    <button @click="facility !== 0 ? facility = 0 : facility = null" class="group flex items-center px-2 py-2 leading-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Facility
                    </button>
                    <div x-show="facility == 0" class="py-2 px-2">
                        <x-label for="facility" :value="__('Facility: ')" />
                        <select class="form-input mt-2 w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium" name="facilityId" id="facilityId">
                            {{-- @foreach ($facilities as $facility)
                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                {{-- </a> --}}
            </div>
            
        </x-slot>
 
        <x-slot name="footer">
            <x-buttons.secondary wire:click="back()" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-buttons.secondary>
            <x-buttons.button wire:click="addPurpose()" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-buttons.button>
        </x-slot>
    </x-modals.add>
</div>
