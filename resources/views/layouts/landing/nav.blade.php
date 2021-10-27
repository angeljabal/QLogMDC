<div class="bg-cyan-900 px-4 py-4">
    <div class="md:max-w-6xl md:mx-auto md:flex md:items-center md:justify-between">
      <div class="flex justify-between items-center">
        {{-- <a href="#"><img src="{{asset('images/logo.png')}}" alt="" srcset="" style="width: 80px"></a> --}}
        <a href="/">
          <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
      </div>
      
      <div class="hidden md:block">
        @if (Auth::check())
          <a
          href="{{ url('/dashboard') }}"
          class="inline-block py-1 md:py-4 text-cyan-200 hover:text-gray-100 mr-6 hover:text-white"
          >Dashboard
          </a>
          <a
          href="{{ url('#') }}"
          class="inline-block py-1 md:py-4 text-cyan-200 hover:text-gray-100 mr-6 hover:text-white"
          >Help
          </a>
          <a
          href="{{ url('#') }}"
          class="inline-block py-1 md:py-4 text-cyan-200 hover:text-gray-100 mr-6 hover:text-white"
          >Privacy
          </a>

        @else
          <a
          href="{{ url('/login') }}"
          class="inline-block py-1 md:py-4 text-cyan-200 hover:text-gray-100 mr-6 hover:text-white"
          >Login
          </a>

          <a
            href="{{ url('/register') }}"
            class="inline-block py-2 px-4 text-gray-700 bg-cyan-300 rounded-lg hover:text-white hover:bg-cyan-600"
            >Sign Up
          </a>
        @endif
        
        
      </div>
    </div>
  </div>