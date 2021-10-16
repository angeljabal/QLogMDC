<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    
    <div class="mt-8">
        <!-- Activity table (small breakpoint and up) -->
        <div class="hidden sm:block">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between w-full">
                    <div class="">
                        <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                            List of Users
                        </h2>
                    </div>
                    <div class="flex items-center text-center">
                        <label for="search">Search</label>       
                        <input wire:model.lazy="search" type="text" class="ml-2 text-sm p-4">
                    </div>
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
                                    <th class="hidden px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider md:block">
                                        Phone Number
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($profiles as $profile)
                                    <tr class="bg-white">
                                        <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex">
                                            <a href="{{ route('admin.users.edit', ['user'=>$profile->user->id]) }}" class="group inline-flex space-x-2 truncate text-sm">
                                                <p class="text-gray-500 truncate group-hover:text-gray-900">
                                                    {{$profile->user->name}}
                                                </p>
                                            </a>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                            <span class="text-gray-900 font-medium">{{$profile->address}}</span>
                                        </td>
                                        <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                            <span class="text-gray-900 font-medium">
                                            {{-- {{$profile->department->acronym}} --}}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                
                                <!-- More transactions... -->
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination">
                            
                        {{ $profiles->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
