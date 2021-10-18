<div class="bg-cyan-900 px-4 py-4">
    <div
      class="md:max-w-6xl md:mx-auto md:flex md:items-center md:justify-between"
    >
      <div class="flex justify-between items-center">
        <a href="#"><img src="{{asset('images/logo.png')}}" alt="" srcset="" style="width: 80px"></a>
        {{-- <div
          class="inline-block cursor-pointer md:hidden">
          <div class="bg-gray-400 w-8 mb-2" style="height: 2px;"></div>
          <div class="bg-gray-400 w-8 mb-2" style="height: 2px;"></div>
          <div class="bg-gray-400 w-8" style="height: 2px;"></div>
        </div> --}}
      </div>
      
      {{-- <div>
        <div class="hidden md:block">
          <a
            href="#"
            class="inline-block py-1 md:py-4 text-gray-100 mr-6 font-bold"
            >How it Works</a
          >
          <a
            href="#"
            class="inline-block py-1 md:py-4 text-cyan-200 hover:text-gray-100 mr-6"
            >Services</a
          >
          <a
            href="#"
            class="inline-block py-1 md:py-4 text-cyan-200 hover:text-gray-100"
            >Blog</a
          >
        </div>
      </div> --}}
      <div class="hidden md:block">
        <a
          href="{{ url('/login') }}"
          class="inline-block py-1 md:py-4 text-cyan-200 hover:text-gray-100 mr-6 hover:text-white"
          >Login</a
        >
        <a
          href="{{ url('/register') }}"
          class="inline-block py-2 px-4 text-gray-700 bg-cyan-300 rounded-lg hover:text-white hover:bg-cyan-600"
          >Sign Up</a
        >
      </div>
    </div>
  </div>