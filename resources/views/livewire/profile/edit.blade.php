<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mx-10 mt-10">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          Edit Profile
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
          Personal details and application.
        </p>
      </div>
      <div class="border-t border-gray-200">
        <dl>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Full name
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <x-input wire:model.defer="name" type="text" value="{{ $this->user->name }}"/>
              @error('name') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
            </dd>
          </div>

          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Profile
              <p class="mt-1 max-w-2xl text-xs font-thin">
                Personal details and application.
              </p>
            </dt>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Address <br>
            </dt>
              <dd class="grid grid-cols-2 gap-2 items-center sm:mt-0 sm:col-span-2 text-gray-900 ">
  
                <div class="col-span-1">
                    <x-label for="brgy" :value="__('Barangay')" />
                    <x-input wire:model.defer="brgy" type="text" name="brgy" :value="old('brgy')"  required />
                </div>
  
                <div class="col-start-1 mt-2">
                    <x-label for="city_town" :value="__('City/Town')" />
                    <x-input wire:model.defer="city_town" type="text" name="city_town" :value="old('city_town')" required />
                </div>
  
                <div class="mt-2">
                    <x-label for="province" :value="__('Province')" />
                    <x-input wire:model.defer="province" type="text" name="province" :value="old('province')" required />
                </div>
                @error('address') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
              </dd>
  
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Phone Number
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <x-input wire:model.defer="phone_number" type="text" value="{{ $this->user->profile->phone_number }}"/>
              @error('phone_number') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
            </dd>
          </div>
          
          <div class="flex justify-end text-center bg-white px-8 py-5">
            <button wire:click="submit" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md hover:bg-cyan-600">Update</button>
            <x-buttons.secondary class="p-4 m-1 text-sm" wire:click="back">{{ __('Back') }}</x-buttons.secondary>
          </div>
        </dl>
      </div>
    </div>
</div>

  
