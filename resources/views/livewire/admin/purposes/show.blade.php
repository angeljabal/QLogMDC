<div>
    <div class="flex items-center m-20 w-1/2">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-10 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="px-10 text-sm font-medium text-gray-500">
                        Purpose
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $this->purpose->title }} 
                        {{-- <span class="mt-1 text-sm text-teal-700 sm:mt-0 sm:col-span-2"> ({{$this->user->role}})</span> --}}
                        </dd>
                    </div>
    
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        Facility
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{-- {{$this->user->email}} --}}
                        </dd>
                    </div>
                
                </dl>
            </div>
            <div class="flex justify-end text-center bg-white px-8 py-5">
                <button wire:click="edit" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md">Edit</button>
                {{-- <a href="{{ route('admin.users.edit', ['purpose'=>$this->purpose->id]) }}" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md hover:bg-cyan-600">Edit</a>
                <a href="{{ route('admin.users.index') }}" class="p-4 m-1 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-700">Back</a> --}}
            </div>
        </div>
    
    </div>
    
</div>