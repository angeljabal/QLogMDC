
<div wire:poll.5000ms.visible>
    <x-status.success :success="session('message')"></x-status.success>
    <x-status.deleted :deleted="session('deleted')"></x-status.deleted>
   
    <div class="grid grid-cols-4 px-5">
        <div class="md:col-span-3 col-span-4  space-y-8 px-12">
            <div class="mt-8 p-4">
                <h1 class="font-bold md:text-5xl text-2xl  text-center">CURRENT SERVING</h1>
                <div class="flex items-center justify-center w-full mt-2">
                    <label for="autoServe" class="flex items-center cursor-pointer">
                      <div class="relative">
                        <input wire:model.lazy="autoServe" id="autoServe" type="checkbox" class="sr-only" />
                        <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                        <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
                      </div>
                      <div class="ml-3 text-gray-700 font-medium">
                        Auto Serve
                      </div>
                    </label>
                    
                </div>
            </div>
            @foreach ($current_serving as $serving)
                <div class="mt-8 p-4 sm:items-center rounded-md bg-white shadow-lg">
                    <hr>
                    <div class="rounded text-center m-5">
                        <h1 class="text-7xl font-bold text-yellow-600">{{$serving->queue_no}}</h1>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t">
                        <dt class="text-m font-medium text-gray-500">
                        Name:
                        </dt>
                        <dd class="mt-1 text-m font-semibold capitalize text-gray-900 sm:mt-0 sm:col-span-2 md:text-right text-left">
                            {{$serving->user->name}}
                        </dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b">
                        <dt class="text-m font-medium text-gray-500">
                        Purpose:
                        </dt>
                        <dd class="mt-1 text-m font-semibold capitalize text-gray-900 sm:mt-0 sm:col-span-2 md:text-right text-left">
                            {{$serving->purpose}}
                        </dd>
                    </div>
                    <div class="flex justify-end text-center bg-white py-4">
                        <x-buttons.secondary wire:click="changeStatus({{$serving->id}}, 'skipped')" class="mr-2">Skip</x-buttons.secondary>
                        <x-buttons.button wire:click="changeStatus({{$serving->id}}, 'completed')">Done</x-buttons.button>
                    </div>
                    
                </div>
            @endforeach
        </div>
        
        <div class="col-span-4 md:mt-3 mt-5 md:col-span-1 bg-white sm:block grid grid-cols-3 w-full">
            <div class="text-center">
                <select wire:model.lazy="status" class="w-full py-6 border-b-2 text-xl text-gray-600 px-8 capitalize focus:outline-none">
                    @foreach ($statuses as $key => $value)
                        <option value="{{$value}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="align-middle min-w-full shadow overflow-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead><tr>
                        <th class="px-3 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            #
                        </th>
                        <th class="px-3 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
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
                                @if ($loop->first && $log->status != "completed" || $log->status == "skipped")
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
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
