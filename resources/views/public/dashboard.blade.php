@extends('layouts.admin')

@section('content')
    <div class="bg-white shadow">
        <input type="hidden">
        <div class="px-4 sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
        <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
            <div class="flex-1 min-w-0">
                <!-- Profile -->
                <div class="flex items-center">
                    <img class="hidden h-16 w-16 rounded-full sm:block" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.6&w=256&h=256&q=80" alt="">
                    <div>
                    <div class="flex items-center">
                        <img class="h-16 w-16 rounded-full sm:hidden" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.6&w=256&h=256&q=80" alt="">
                        <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                            {{auth()->user()->name}}
                        </h1>
                    </div>
                    <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                        @if (auth()->user()->hasAnyRole('head', 'admin'))
                        <dd class="mt-3 flex items-center text-sm text-gray-500 font-medium sm:mr-6 sm:mt-0 capitalize text-green-500">
                              <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                              </svg>
                            {{auth()->user()->hasRole('admin') ? 'Admin' : 'Facility Head'}}
                        </dd>
                        @endif
                        <dd class="flex items-center text-sm text-gray-500 font-medium capitalize sm:mr-6">
                            <!-- Heroicon name: solid/office-building -->
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                            </svg>
                            {{auth()->user()->hasRole('head') ? auth()->user()->facility->name : auth()->user()->profile->address}}
                        </dd>
                    </dl>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                <a href="{{auth()->user()->hasRole('head') ? url('/facility') : url('/logs')}}" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                {{auth()->user()->hasRole('head') ? 'View Facility' : 'Checkout logs'}}
                </a>
                <a href="{{route('generate-qrcode')}}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                Generate QRCode
                </a>
            </div>
        </div>
        </div>
    </div>
    <div class="mt-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- <h2 class="text-lg inline leading-6 font-medium text-gray-900">Overview</h2>
        <h2 class="text-xs inline leading-6 text-gray-500">({{$today}})</h2> --}}
        <div class="flex flex-wrap items-center">
            <div class="relative w-full max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-lg text-base text-gray-900">Overview</h3>
            </div>
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0 ">
                    <div class="relative">
                        <select wire:model.lazy="perPage"
                            class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-200  text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative">
                        
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative">
                       
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flatpickr">
            <input type="text" placeholder="Select Date.." data-input> <!-- input is mandatory -->
        
            <a class="input-button" title="toggle" data-toggle>
                <i class="icon-calendar"></i>
            </a>
        
            <a class="input-button" title="clear" data-clear>
                <i class="icon-close"></i>
            </a>
        </div>
        <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <!-- HEAD OVERVIEW-->
            @if(auth()->user()->hasRole('head'))
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/scale -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                              </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-yellow-600 truncate">
                                    Waiting
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{$waiting}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/queue')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-teal-500 truncate">
                                    Completed
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{$completed}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/logs')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/scale -->
                            <svg class="h-6 w-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-cyan-600 truncate">
                                    Total Transactions
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{$transactions}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/facility')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
            <!-- ADMIN OVERVIEW-->
            @elseif (auth()->user()->hasRole('admin'))
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/scale -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-yellow-600 truncate">
                                    Waiting
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{-- {{$waiting}} --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/queue')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-teal-500 truncate">
                                    Completed
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{-- {{$completed}} --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/logs')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/scale -->
                            <svg class="h-6 w-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-cyan-600 truncate">
                                    Walk-ins
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{-- {{$transactions}} --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/facility')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/scale -->
                            <svg class="h-6 w-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-cyan-600 truncate">
                                    Facilities Available
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{-- {{$transactions}} --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/facility')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/scale -->
                            <svg class="h-6 w-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-cyan-600 truncate">
                                    Total Transactions
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{-- {{$transactions}} --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/facility')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/scale -->
                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total Facilities Visits Today
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                    {{$count}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                        <a href="{{url('/logs')}}" class="font-medium text-cyan-700 hover:text-cyan-900">
                        View all
                        </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        </div>
        @if (isset($logs) && $logs->count()!=0 && !auth()->user()->hasAnyRole('head|admin'))
            <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                Recent activity
            </h2>
            <!-- Activity list (smallest breakpoint only) -->
            <div class="shadow sm:hidden">
                {{-- <ul role="list" class="mt-2 divide-y divide-gray-200 overflow-hidden shadow sm:hidden">
                    <li>
                        <a href="#" class="block px-4 py-4 bg-white hover:bg-gray-50">
                            <span class="flex items-center space-x-4">
                            <span class="flex-1 flex space-x-2 truncate">
                                <!-- Heroicon name: solid/cash -->
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                <span class="flex flex-col text-gray-500 text-sm truncate">
                                <span class="truncate">Payment to Molly Sanders</span>
                                <span><span class="text-gray-900 font-medium">$20,000</span> USD</span>
                                <time datetime="2020-07-11">July 11, 2020</time>
                                </span>
                            </span>
                            <!-- Heroicon name: solid/chevron-right -->
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            </span>
                        </a>
                    </li>
                    <!-- More transactions... -->
                </ul> --}}
                <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200" aria-label="Pagination">
                    <div class="flex-1 flex justify-between">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500">
                        Previous
                        </a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500">
                        Next
                        </a>
                    </div>
                </nav>
            </div>
            <!-- Activity table (small breakpoint and up) -->
            <div class="hidden sm:block">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col mt-2">
                        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Purpose
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Facility Visited
                                        </th>
                                        <th class="hidden px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider md:block">
                                            Time In
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($logs as $log)
                                        <tr class="bg-white">
                                                
                                            <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex">
                                                <a href="#" class="group inline-flex space-x-2 truncate text-sm">
                                                    <!-- Heroicon name: solid/cash -->
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <p class="text-gray-500 truncate group-hover:text-gray-900">
                                                        {{$log->purpose}}
                                                    </p>
                                                </a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                                <span class="text-gray-900 font-medium">
                                                    {{$log->facility != null ? $log->facility->name : ''}}
                                                </span>
                                            </td>
                                            <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                                    {{$log->created_at->format('g:i A')}}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                                <time datetime="2020-07-11">{{$log->created_at->format('M d, Y')}}</time>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- More transactions... -->
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <nav class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6" aria-label="Pagination">
                                    {{ $logs->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- <div class="form-group check-in">
        <input type="text" name="check-in" id="check-in" class="form-input" placeholder="Check-In">
      </div>
      <div class="form-group check-out">
        <input type="text" name="check-out" id="check-out" class="form-input" placeholder="Check-Out"> --}}
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/l10n/id.js"></script>
    <script>
        $("#check-in").flatpickr({
        enableTime: false,
        disableMobile: true,
        dateFormat: "l, j F Y",
        minDate: "today",
        time_24hr: true,
        locale: "id"
        });

        $("#check-out").flatpickr({
        enableTime: false,
        disableMobile: true,
        dateFormat: "l, j F Y",
        minDate: "today",
        time_24hr: true,
        locale: "id"
        });
        
    </script>
@endpush
