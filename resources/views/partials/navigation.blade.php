
<div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:border-none">
    <button type="button" class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
    </button>
    <div class="flex-1 px-4 flex justify-between sm:px-6 lg:max-w-full lg:mx-auto lg:px-8">
        <div class="flex-1 flex">
        </div>
        <div class="ml-4 flex items-center md:ml-6">
            <div class="ml-3 relative" x-data="{ 'open' : false }">
                <div>
                <button @click="open = !open" type="button" class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md lg:hover:bg-gray-50" id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                    @click.away="open = false">
                    <span class="ml-3 text-gray-700 text-sm font-medium lg:block"><span class="sr-only">Open user menu for </span>{{auth()->user()->name}}</span>
                    <!-- Heroicon name: solid/chevron-down -->
                    <svg class="flex-shrink-0 ml-1 h-5 w-5 text-gray-400 lg:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                </div>
                
                <div x-show="open" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Active: "bg-gray-100", Not Active: "" -->
                <a href="{{ url('profile') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                @if (Session::has('admin_id'))
                <form method="POST" action="{{ route('loginAsAdmin') }}">
                    @csrf
                    <a href="{{ route('loginAsAdmin') }}" class="block px-4 py-2 text-sm text-gray-700"
                            role="menuitem" tabindex="-1" id="user-menu-item-2"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Login Back as Admin
                    </a>
                </form>
                @endif
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700"
                            role="menuitem" tabindex="-1" id="user-menu-item-2"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
