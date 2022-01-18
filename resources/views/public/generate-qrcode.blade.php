@extends('layouts.admin')

@section('content')

<div>
    <div class="bg-gray-100 flex justify-center items-center mt-10">
        <div class="container w-80 mx-auto  bg-white rounded-xl shadow-lg overflow-hidden">
            <img class="w-full p-5" src="data:image/png;base64, {!! base64_encode($qrcode) !!} ">
            <div class="text-center relative">
            <h1 class="mb-3 text-2xl font-sans font-semibold text-gray-700 hover:text-gray-900 cursor-pointer">{{$name}}</h1>
            <a href="data:image/png;base64, {!! base64_encode($qrcode) !!}  " download="qrcode.png">  
                <x-buttons.button class="m-5" wire:click="download">Download
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </x-buttons.button>
            </a>
          </div>
        </div>
    </div>
</div>

@endsection