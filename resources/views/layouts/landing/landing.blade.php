<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    @include('partials.head')

   <body>
        <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
            <!-- Page header -->
            {{-- @include('layouts.landing.nav') --}}

            @yield('content')

        </main>
      @include('partials.scripts')
   </body>
</html>