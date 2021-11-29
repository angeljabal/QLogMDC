
<div>
    <x-status.success :success="session('message')"></x-status.success>
    <x-status.deleted :deleted="session('deleted')"></x-status.deleted>
   
    <div class="grid grid-cols-3">
        <div class="lg:col-span-2 col-span-3  space-y-8 px-12">
            <div class="mt-8 p-4">
                <h1 class="font-bold text-5xl text-center">CURRENT SERVING</h1>
                <div class="flex items-center justify-center w-full mt-2">
  
                    <label for="autoServe" class="flex items-center cursor-pointer">
                      <!-- toggle -->
                      <div class="relative">
                        <!-- input -->
                        <input wire:model.lazy="autoServe" id="autoServe" type="checkbox" class="sr-only" />
                        <!-- line -->
                        <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                        <!-- dot -->
                        <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
                      </div>
                      <!-- label -->
                      <div class="ml-3 text-gray-700 font-medium">
                        Auto Serve
                      </div>
                    </label>
                    
                </div>
            </div>
            @foreach ($current_serving as $serving)
                <div class="mt-8 p-4 sm:items-center shadow rounded-md bg-white shadow-lg">
                    <hr>
                    <div class="rounded text-center m-5">
                        <h1 class="text-7xl font-bold text-yellow-600">{{$serving->queue_no}}</h1>
                    </div>
                    <hr>
                    <div class="px-8 border-b">
                        <div class="flex justify-between py-4 text-gray-600">
                            <span>Name:</span>
                            <span class="font-semibold text-pink-500">{{$serving->user->name}}</span>
                        </div>
                        <div class="flex justify-between py-4 text-gray-600">
                            <span>Purpose:</span>
                            <span class="font-semibold text-pink-500">{{$serving->purpose}}</span>
                        </div>
                    </div>
                    <div class="flex justify-end text-center bg-white py-4">
                        <x-buttons.secondary wire:click="changeStatus({{$serving->id}}, 'skipped')" class="mr-2">Skip</x-buttons.secondary>
                        <x-buttons.button wire:click="changeStatus({{$serving->id}}, 'completed')">Done</x-buttons.button>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="col-span-1 bg-white lg:block hidden">
            <div class="text-center">
                <select wire:model.lazy="status" class="w-full py-6 border-b-2 text-xl text-gray-600 px-8 capitalize focus:outline-none">
                    @foreach ($statuses as $key => $value)
                        <option value="{{$value}}">{{$value}}</option>
                    @endforeach
                    {{-- <option value="1">Waiting List</option>
                    <option value="2">Skipped</option> --}}
                </select>
            </div>
            <div class="align-middle min-w-full shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead><tr>
                        <th class="px-3 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            #
                        </th>
                        <th class="px-3 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="hidden px-3 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider md:block">
                            Purpose
                        </th>
                    </tr></thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($logs as $log)
                            <tr class="bg-white">
                                <td class="px-3 py-4 text-left whitespace-nowrap text-sm text-gray-500">
                                    <span class="text-gray-900 font-medium">{{$log->queue_no}}</span>
                                </td>
                                <td class="px-3 py-4 text-left whitespace-nowrap text-sm text-gray-500">
                                    <span class="text-gray-900 font-medium">{{$log->user->name}}</span>
                                </td>
                                <td class="px-3 py-4 text-left whitespace-nowrap text-sm text-gray-500">
                                    <span class="text-gray-900 font-medium">{{$log->purpose}}</span>
                                </td>
                                @if ($loop->first && $log->status != "completed" || $log->status == "skipped")
                                    <td class="hidden px-3 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                        <button title="Serve" wire:click="changeStatus({{$log->id}}, 'serving')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 p-1 inline-block bg-teal-500 text-white hover:bg-teal-400 hover:text-gray-700 rounded-md" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    #autoServe:checked ~ .dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
</style>
