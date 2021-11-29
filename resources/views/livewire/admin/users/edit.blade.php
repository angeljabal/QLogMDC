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
            <x-input wire:model.defer="name" type="text" value="{{ $this->user->name }}"/>
            @error('name') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Email address
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <x-input wire:model.defer="email" type="text" value="{{ $this->user->email }}"/>
            @error('email') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Type
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <select wire:model.defer="type" class="form-input shadow border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium" name="type" id="type">
              @foreach ($types as $key => $value)
              <option value="{{ $value }}" {{ $value === $type ? 'selected' : '' }}>{{ $value }}</option>
              @endforeach
            </select>
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Role
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <div wire:ignore>
                  <select
                          class="js-example-basic-multiple w-1/2 capitalize"
                          data-placeholder="Select facilities..."
                          data-allow-clear="false"
                          multiple="multiple"
                          id="facilities"
                          title="Select facility...">
                      @foreach ($roles as $value)
                      <option value="{{ $value->name }}" {{in_array($value->name, $role) ? 'selected' : ''}}>{{$value->name}}</option>
                    @endforeach
                  </select>
              </div>
              
              @error('role') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
          </dd>
        </div>
        
        @if (in_array('head', $this->role))
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Facility
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <div>
                <select wire:model.defer="facilityId" class="form-input mt-2 w-1/2 shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium" name="facilityId" id="facilityId">
                  <option hidden="true">Choose Facility</option>
                  <option selected disabled>Choose Facility</option>
                  @foreach ($facilities as $faci)
                  <option value="{{ $faci->id }}" {{ $faci->id === $facilityId ? 'selected' : '' }}>{{ $faci->name}} </option>
                  @endforeach
                </select>
              </div>

              @error('facilityId') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
            </dd>
          </div>
        @endif

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
            {{-- <input class="px-4 py-2 w-full" type="text" value="{{ $this->user->profile->address }}"> --}}
            {{-- <select wire:model.defer="department" class="px-4 py-2 w-1/2" name="" id="">
              @foreach ($departments as $key => $value)
                  <option value="{{ $key }}" {{ $key === $department ? 'selected' : '' }}>{{ $value }}</option>
              @endforeach
            </select> --}}
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

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.selectpicker').select2();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        $('#facilities').on('change', function(){
            @this.set('role', $(this).val());
            console.log($(this).val());
        });
    </script>
@endpush
