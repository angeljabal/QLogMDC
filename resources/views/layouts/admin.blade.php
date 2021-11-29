<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.head')

   <body>
      <div class="relative h-screen flex overflow-hidden bg-gray-100">

        @include('partials.sidebar')

         <div class="flex-1 overflow-auto focus:outline-none">

            @include('partials.navigation')

            <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
               <!-- Page header -->

                @yield('content')

            </main>
         </div>
      </div>
      @include('partials.scripts')
   </body>
</html>
