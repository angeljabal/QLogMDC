<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <meta http-equiv = "refresh" content = "10; url = {{url('/')}}" /> --}}
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireStyles
    </head>
    <body>
        {{-- <div wire:loading id="loadingDiv" class="loader-wrapper fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
            <div style="border-top-color:transparent"
                    class="w-16 h-16 border-4 border-blue-400 border-solid rounded-full animate-spin mb-4"></div>
            <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
            <p class="w-1/3 text-center text-white">This may take a few seconds, please wait</p>
        </div> --}}
        {{-- <div id="page-loader">
            <div wire:loading id="loadingDiv" class="loader-wrapper fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
                <div style="border-top-color:transparent"
                        class="w-16 h-16 border-4 border-blue-400 border-solid rounded-full animate-spin mb-4"></div>
                <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
                <p class="w-1/3 text-center text-white">This may take a few seconds, please wait</p>
            </div>
	    </div> --}}
            {{ $slot }}
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script  language="JavaScript" type="text/JavaScript">
    // $(window).on('load', function(){
    //   setTimeout(removeLoader, 1000); //wait for page load PLUS two seconds.
    // });
    // function removeLoader(){
    //     $( "#loadingDiv" ).fadeOut(500, function() {
    //       // fadeOut complete. Remove the loading div
    //       $( "#loadingDiv" ).remove(); //makes page more lightweight 
    //   });  
    // } 
//        $('a').click(function(){
//    $('<div class=loadingDiv>loading...</div>').prependTo(document.body); 
// });
        </script>
        @include('partials.scripts')
    </body>
</html>
