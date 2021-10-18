<div>

    @if(session()->has('message'))
    <div class="px-4 py-5 sm:px-6">
      <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
            <p class="font-bold">{{session('message')}}</p>
          </div>
        </div>
      </div>
    </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
            User Information
        </div>
        <div class="border-t border-gray-200">
            <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Full name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $this->user->name }} 
                {{-- <span class="mt-1 text-sm text-teal-700 sm:mt-0 sm:col-span-2"> ({{$this->user->role}})</span> --}}
                </dd>
            </div>

              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">
                  Email address
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{$this->user->email}}
                  </dd>
              </div>
            
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">
                  User Type
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{$this->user->type}}
                  </dd>
              </div>
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">
                  Role
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{$this->user->role}}
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
                  Address
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{$this->user->profile->address}}
                  </dd>
              </div>
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">
                  Phone Number
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{$this->user->profile->phone_number}}
                  </dd>
              </div>
            </div>
            </div>
            </dl>
        </div>
        <div class="flex justify-end text-center bg-white px-8 py-5">
            {{-- <button wire:click="edit" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md">Edit</button> --}}
            <a href="{{ route('admin.users.edit', ['user'=>$this->user->id]) }}" class="btn p-4 m-1 text-sm text-white bg-cyan-600 rounded-md">Edit</a>
            <button wire:click="back" class="p-4 m-1 text-sm text-white bg-gray-400 rounded-md">Back</button>
        </div>
    </div>

</div>