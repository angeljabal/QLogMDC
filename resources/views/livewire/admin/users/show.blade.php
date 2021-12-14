<div>
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
                  <dd class="mt-1 text-sm capitalize text-gray-900 sm:mt-0 sm:col-span-2">
                  {{$this->user->roles->pluck('name')->implode(' | ')}}
                  </dd>
              </div>
              @if ($this->user->facility()!=null&&isset($this->user->facility->name))
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Facility
                    </dt>
                    <dd class="mt-1 text-sm capitalize text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$this->user->facility->name}}
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
            <a href="{{ route('admin.users.edit', ['user'=>$this->user->id]) }}" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md hover:bg-cyan-600">Edit</a>
            <a href="{{ route('admin.users.index') }}" class="p-4 m-1 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-700">Back</a>
        </div>
    </div>

</div>
