<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mx-10 mt-10">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          Change Password
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
          Personal details and application.
        </p>
      </div>
      <div class="border-t border-gray-200">
        <dl>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Old Password
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <x-input wire:model.defer="old_password" type="password"/>
              @error('old_password') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
            </dd>
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              New Password
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <x-input wire:model.defer="password" type="password"/>
              @error('password') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
            </dd>
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Confirm Password
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <x-input wire:model.defer="password_confirmation" type="password"/>
              @error('password_confirmation') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
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

  
