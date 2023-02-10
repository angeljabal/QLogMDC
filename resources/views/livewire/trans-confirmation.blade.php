{{-- <x-guest-layout> --}}
{{-- @if (isset($purposeId)) --}}
@if (isset($officeId))
    <livewire:queue.receipt :officeId='$officeId'/>
@else
<div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-cyan-500 to-blue-500 p-5">
    @if (isset($departments))
        <div class="w-full max-w-5xl px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg text-center mb-5">
            <div class="px-4 py-5 sm:px-6 grid-cols-3">
                <h3 class="text-2xl font-extrabold uppercase leading-6 text-gray-900">
                Select Department
            </div>
            <div class="border-t border-gray-200 py-4">
                <div class="px-4 py-5 w-full">
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <select wire:model.defer="department" class="form-input shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium" name="type" id="type">
                            <option hidden="true">Select Department</option>
                            <option selected disabled>Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        @error('department') <span class="mt-2 text-xl font-semibold text-red-600">{{ $message }}</span>  @enderror
                    </dd>
                </div>  
            </div>
        </div>
    @endif
    <div class="w-full max-w-5xl px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg text-center">
        <div class="px-4 py-5 sm:px-6 grid-cols-3">
            <h3 class="text-2xl font-extrabold uppercase leading-6 text-gray-900">
            Confirm Details
        </div>
        <div class="border-t border-gray-200 py-4">
            <h5 class="text-4xl font-medium text-gray-500 pb-5">
                Name: {{auth()->user()->fname . ' ' . auth()->user()->lname}}
            </h5>
            <h5 class="text-4xl font-medium text-gray-500 pb-5">
                Purpose: {{$purpose_title}}
            </h5>
            <div class="text-center px-8 py-10 border-t">
                <button wire:click="submit" id="external-link" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md hover:bg-cyan-600">Confirm </button>
                <a href="/" id="external-link" class="p-4 m-1 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-700">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endif
{{-- @endif --}}
{{-- </x-guest-layout> --}}