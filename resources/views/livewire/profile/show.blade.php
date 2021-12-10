<div>
    <x-status.success :success="session('message')"></x-status.success>
    <x-status.deleted :deleted="session('deleted')"></x-status.deleted>
    <div class="bg-white shadow sm:rounded-lg mx-10 mt-10">
        <div class="px-4 py-5 sm:px-6 grid-cols-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
            Your Profile
        </div>
        <div class="border-t border-gray-200">
            <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                Full name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{auth()->user()->name}}
                </dd>
            </div>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Email address
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{auth()->user()->email}}
                </dd>
                </div>
            
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    User Type
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{auth()->user()->type}}
                </dd>
                </div>
                @if (auth()->user()->facility()!=null)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Role
                    </dt>
                    <dd class="mt-1 text-sm capitalize text-gray-900 sm:mt-0 sm:col-span-2">
                    {{auth()->user()->roles->pluck('name')->implode(' | ')}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Facility
                    </dt>
                    <dd class="mt-1 text-sm capitalize text-gray-900 sm:mt-0 sm:col-span-2">
                    {{auth()->user()->facility->name}}
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
                    {{auth()->user()->profile->address}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                    Phone Number
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{auth()->user()->profile->phone_number}}
                    </dd>
                </div>
            </div>
            </div>
            </dl>
        </div>
        <div class="flex justify-end text-center px-8 py-5">
            <a href="{{ url('profile/edit') }}" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md hover:bg-cyan-600">Edit Profile
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
            </span>
            </a>
        </div>
    </div>
</div>
