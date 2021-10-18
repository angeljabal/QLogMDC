<div>
  
  <div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        User Information
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
            <input wire:model.defer="name" class="px-4 py-2 w-full" type="text" value="{{ $this->user->name }}">
            @error('name') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Email address
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <input wire:model.defer="email" class="px-4 py-2 w-full" type="text" value="{{ $this->user->email }}">
            @error('email') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
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
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Address
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <input wire:model.defer="address" class="px-4 py-2 w-full" type="text" value="{{ $this->user->profile->address }}">
            @error('address') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Department
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{-- <input class="px-4 py-2 w-full" type="text" value="{{ $this->user->profile->address }}"> --}}
            <select wire:model.defer="department" class="px-4 py-2 w-1/2" name="" id="">
              @foreach ($departments as $key => $value)
                  <option value="{{ $key }}" {{ $key === $department ? 'selected' : '' }}>{{ $value }}</option>
              @endforeach
            </select>
          </dd>
        </div>
        <div class="flex justify-end text-center bg-white px-8 py-5">
          <button wire:click="submit" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md hover:bg-cyan-600">Update</button>
          <button wire:click="back" class="p-4 m-1 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-500">Back</button>
          {{-- <a href="{{ route('admin.users.show', ['user'=>$this->user->id]) }}" class="btn p-4 m-1 text-sm text-white bg-gray-400 rounded-md">Back</a> --}}
        </div>
      </dl>
    </div>
  </div>
  
</div>