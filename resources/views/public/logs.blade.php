@extends('layouts.admin')

@section('content')
<div>
    <div class="hidden sm:block">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-20">
            <div class="">
                <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
                    {{auth()->user()->hasRole('head') ? "Logs: ($facility)" : "Logs"}}
                </h2>
            </div>
            <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Purpose
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{auth()->user()->hasRole('head') ? 'Name' : 'Facility Visited'}}
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                        <p class="text-gray-500 truncate group-hover:text-gray-900">
                                            {{$log->purpose}}
                                        </p>
                                    </a>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                    <span class="text-gray-900 font-medium">
                                        {{auth()->user()->hasRole('head') ? $log->user->name : ($log->facility != null ? $log->facility->name : '')}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="text-gray-900 text-xs text-center">
                                        {{$log->created_at->format('g:i A')}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center text-xs font-medium capitalize">{{$log->created_at->format('M d, Y')}}</span>
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
</div>
@endsection
