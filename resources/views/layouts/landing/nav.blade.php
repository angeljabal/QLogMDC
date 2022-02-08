<div class="bg-cyan-900 px-4 py-4">
      <div class="flex justify-between items-center">
        {{-- <a href="#"><img src="{{asset('images/logo.png')}}" alt="" srcset="" style="width: 80px"></a> --}}
        <a href="/">
          <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>

        <div class="md:block pr-7 p-4">
            @if (Auth::check())
              <a
              href="{{ url('/dashboard') }}"
              class="inline-block py-1 md:py-4 text-cyan-200 md:mr-6 mr-2 hover:text-white text-sm md:text-base"
              >Dashboard
              </a>
              {{-- <a
              href="{{ url('#') }}"
              class="inline-block py-1 md:py-4 text-cyan-200 md:mr-6 mr-2 hover:text-white text-sm md:text-base"
              >Help
              </a>
              <a
              href="{{ url('#') }}"
              class="inline-block py-1 md:py-4 text-cyan-200 md:mr-6 mr-2 hover:text-white text-sm md:text-base"
              >Privacy
              </a> --}}

            @else
              <a
              href="{{ url('/login') }}"
              class="inline-block py-1 md:py-4 text-cyan-200 mr-6 hover:text-white"
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
