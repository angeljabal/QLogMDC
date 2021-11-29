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
          <dd class="capitalize mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{-- @foreach ($role as $value)
              <div class='w-full pr-2'>
                <label class="inline-flex items-center capitalize">
                  <span><li>{{$value}}</li></span>
                </label>
              </div>
            @endforeach --}}
            {{-- <select wire:model.lazy="role" class="form-input w-1/2 shadow border rounded py-2 px-3 capitalize text-gray-700 leading-tight focus:outline-none font-medium" name="role" id="role">
              @foreach ($roles as $value)
              <option value="{{ $value->name }}">{{$value->name}}</option>
              @endforeach
            </select> --}}

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
            <dd class="grid grid-cols-3 items-center sm:mt-0 sm:col-span-2 text-gray-900 ">

              <div class='w-full pr-2'>
                  <x-label for="brgy" :value="__('Barangay')" />
                  <x-input wire:model.defer="brgy" type="text" name="brgy" :value="old('brgy')"  required />
              </div>

              <div class='w-full pr-2'>
                  <x-label for="city_town" :value="__('City/Town')" />
                  <x-input wire:model.defer="city_town" type="text" name="city_town" :value="old('city_town')" required />
              </div>
              <div class='w-full pr-2'>
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

<div>

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <select x-cloak id="select">
        @foreach ($role as $value)
        <option value="{{ $value }}" selected>{{$value}}</option>
        @endforeach
        @foreach ($roles as $value)
              <option value="{{ $value->name }}">{{$value->name}}</option>
        @endforeach
    </select>

<div x-data="dropdown()" x-init="loadOptions()" class="w-full md:w-1/2 flex flex-col items-center h-64 mx-auto">
  <form>
      <input type="text" wire:model.lazy="selectedRoles" type="text" x-bind:value="selectedValues()">
      <h1>{{$selectedRoles}}</h1>
      <input name="values" type="hidden" x-bind:value="selectedValues()">
      <div class="inline-block relative w-64">
          <div class="flex flex-col items-center relative">
              <div x-on:click="open" class="w-full  svelte-1l8159u">
                  <div class="my-2 p-1 flex border border-gray-200 bg-white rounded svelte-1l8159u">
                      <div class="flex flex-auto flex-wrap">
                          <template x-for="(option,index) in selected" :key="options[option].value">
                              <div
                                  class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full text-teal-700 bg-teal-100 border border-teal-300 ">
                                  <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                      options[option]" x-text="options[option].text"></div>
                                  <div class="flex flex-auto flex-row-reverse">
                                      <div x-on:click.stop="remove(index,option); $dispatch('input', selectedValues())">
                                          <svg class="fill-current h-6 w-6 " role="button" viewBox="0 0 20 20">
                                              <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                         c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                         l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                         C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                          </svg>

                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div x-show="selected.length == 0" class="flex-1">
                              <input placeholder="Select a option"
                                  class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                  x-bind:value="selectedValues()"
                              >
                          </div>
                      </div>
                      <div
                          class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

                          <button type="button" x-show="isOpen() === true" x-on:click="open"
                              class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                              <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                  <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                    c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                    L17.418,6.109z" />
                              </svg>

                          </button>
                          <button type="button" x-show="isOpen() === false" @click="close"
                              class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                              <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                  <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                    c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                    " />
                              </svg>
                          </button>
                      </div>
                  </div>
              </div>
              <div class="w-full px-4">
                  <div x-show.transition.origin.top="isOpen()"
                      class="absolute shadow top-100 bg-white z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj"
                      x-on:click.away="close">
                      <div class="flex flex-col w-full">
                          <template x-for="(option,index) in options" :key="option">
                              <div>
                                  <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100"
                                  @click="select(index,$event); $dispatch('input', selectedValues())"
                                  >
                                      <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                          class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                          <div class="w-full items-center flex">
                                              <div class="mx-2 leading-6" x-text="option.text"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </template>
                      </div>
                  </div>
              </div>
          </div>
  </form>
      {{-- <div x-show="selected." class="flex-1">
          <div class="mt-5" x-show="values == 'head'">
            <x-label for="facility" :value="__('Facility: ')" />
            <select wire:model.defer="facilityId" class="form-input mt-2 w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium" name="facilityId" id="facilityId">
              @foreach ($facilities as $facility)
              <option value="{{ $facility->id }}" {{ $facility->id === $facilityId? 'selected' : '' }}>{{ $facility->name }}</option>
              @endforeach
            </select>
          </div>
      </div> --}}
</div>

</div>
        <div class="flex justify-end text-center bg-white px-8 py-5">
          <button wire:click="submit" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md hover:bg-cyan-600">Update</button>
          <x-buttons.secondary class="p-4 m-1 text-sm" wire:click="back">{{ __('Back') }}</x-buttons.secondary>
        </div>
      </dl>
    </div>
  </div>
</div>
