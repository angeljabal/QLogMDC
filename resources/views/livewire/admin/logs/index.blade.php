@extends('layouts.admin')

@once
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    @push('head_scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush
@endonce

@section('content')
<div>
    <div>
        <!-- Users table (small breakpoint and up) -->
        <div class="hidden sm:block">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class=" mb-0">
                    {{-- <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-lg text-base text-gray-900">Logs</h3>
                    </div> --}}
                    <div class="flex">
                        <div class="flex-grow flex-1" x-data="app()" x-init="initDate();" x-cloak>
                            <div class="relative" @keydown.escape="closeDatepicker()" @click.away="closeDatepicker()">
                                    <div>
                                        <div class="relative" @keydown.escape="closeDatepicker()" @click.away="closeDatepicker()">
                                            <div class="flex items-center mt-2 rounded-md">
                                                <input type="text" 
                                                        @click="endToShow = 'from'; initDate(); showDatepicker = true" x-model="dateFromValue" 
                                                        :class="{'font-semibold': endToShow == 'from' }" 
                                                        placeholder="Start Date"
                                                        class="focus:outline-none border p-2 w-40 rounded-l-md border-r border-gray-300"/>
                                                <div class="inline-block px-2 h-full">to</div>
                                                <input type="text" @click="endToShow = 'to'; initDate(); showDatepicker = true" x-model="dateToValue" 
                                                        :class="{'font-semibold': endToShow == 'to' }" 
                                                        placeholder="End Date"
                                                        class="focus:outline-none border p-2 w-40 rounded-r-md border-l border-gray-300"/>
                                            </div>
                                            <div 
                                                class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0" 
                                                style="width: 17rem" 
                                                x-show.transition="showDatepicker"
                                            >
                        
                                                <div class="flex justify-between items-center mb-2">
                                                    <div>
                                                        <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                                                        <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                                                    </div>
                                                    <div>
                                                        <button 
                                                            type="button"
                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" 
                                                            @click="if (month == 0) {year--; month=11;} else {month--;} getNoOfDays()">
                                                            <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                            </svg>  
                                                        </button>
                                                        <button 
                                                            type="button"
                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" 
                                                            @click="if (month == 11) {year++; month=0;} else {month++;}; getNoOfDays()">
                                                            <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                            </svg>									  
                                                        </button>
                                                    </div>
                                                </div>
                        
                                                <div class="flex flex-wrap mb-3 -mx-1">
                                                    <template x-for="(day, index) in DAYS" :key="index">	
                                                        <div style="width: 14.26%" class="px-1">
                                                            <div
                                                                x-text="day" 
                                                                class="text-gray-800 font-medium text-center text-xs"
                                                            ></div>
                                                        </div>
                                                    </template>
                                                </div>
                        
                                                <div class="flex flex-wrap -mx-1">
                                                    <template x-for="blankday in blankdays">
                                                        <div 
                                                            style="width: 14.28%"
                                                            class="text-center border p-1 border-transparent text-sm"	
                                                        ></div>
                                                    </template>	
                                                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">	
                                                        <div style="width: 14.28%">
                                                            <div
                                                                @click="getDateValue(date)"
                                                                x-text="date"
                                                                class="p-1 cursor-pointer text-center text-sm leading-none hover:bg-blue-200 leading-loose transition ease-in-out duration-100"
                                                                :class="{'font-bold': isToday(date) == true, 'bg-blue-800 text-white rounded-l-full': isDateFrom(date) == true, 'bg-blue-800 text-white rounded-r-full': isDateTo(date) == true, 'bg-blue-200': isInRange(date) == true, 'cursor-not-allowed opacity-25': isDisabled(date) }"	
                                                                :disabled="isDisabled(date) ? true : false"
                                                            ></div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                        
                                        </div>	 
                                    </div>
                            
                            </div>	 
                        </div>
                        <div class="my-2 flex-1">
                            <div class="block relative">
                                <select wire:model.lazy="facility"
                                        class="appearance-none  h-full rounded-md border block rounded w-full bg-white text-gray-700 py-2 px-5 pr-8 leading-tight focus:outline-none focus:bg-white">
                                        <option value="0">All</option>
                                        @foreach ($facilities as $faci)
                                        <option value="{{$faci->id}}">{{$faci->name}}</option>
                                        @endforeach
                                </select>
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
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-x-auto overflow-hidden sm:rounded-lg">
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

    <div class="antialiased sans-serif">
        <script>
            const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    
            function app() {
                return {
                    showDatepicker: false,
                    dateFromYmd: '',
                    dateToYmd: '',
                    dateFromValue: '',
                    dateToValue: '',
                    currentDate: null,
                    dateFrom: null,
                    dateTo: null,
                    endToShow: '',
                    month: '',
                    year: '',
                    no_of_days: [],
                    blankdays: [],
                    
                    convertFromYmd(dateYmd) {
                        const year = Number(dateYmd.substr(0, 4));
                        const month = Number(dateYmd.substr(5, 2)) - 1;
                        const date = Number(dateYmd.substr(8, 2));
                        
                        return new Date(year, month, date);
                    },
                    
                    convertToYmd(dateObject) {
                        const year = dateObject.getFullYear();
                        const month = dateObject.getMonth() + 1;
                        const date = dateObject.getDate();
                        
                        return year + "-" + ('0' + month).slice(-2) + "-" +  ('0' + date).slice(-2);
                    },
    
                    initDate() {
                        if ( ! this.dateFrom ) {
                            if ( this.dateFromYmd ) {
                                this.dateFrom = this.convertFromYmd( this.dateFromYmd );
                            //} else if ( this.endToShow ) {
                            //	this.dateFrom = new Date();
                            }
                        }
                        if ( ! this.dateTo ) {
                            if ( this.dateToYmd ) {
                                this.dateTo = this.convertFromYmd( this.dateToYmd );
                            //} else if ( this.endToShow ) {
                            //	this.dateTo = new Date();
                            }
                        }
                        if ( ! this.dateFrom ) {
                            this.dateFrom = this.dateTo;
                        }
                        if ( ! this.dateTo ) {
                            this.dateTo = this.dateFrom;
                        }
                        if ( this.endToShow === 'from' && this.dateFrom ) {
                            this.currentDate = this.dateFrom;
                        } else if ( this.endToShow === 'to' && this.dateTo ) {
                            this.currentDate = this.dateTo;
                        } else {
                            this.currentDate = new Date();
                        }
                        currentMonth = this.currentDate.getMonth();
                        currentYear = this.currentDate.getFullYear();
                        if ( this.month !== currentMonth || this.year !== currentYear ) {
                            this.month = currentMonth;
                            this.year = currentYear;
                            this.getNoOfDays();
                        }
                        this.setDateValues();
                    },
    
                    isToday(date) {
                        const today = new Date();
                        const d = new Date(this.year, this.month, date);
    
                        return today.toDateString() === d.toDateString();
                    },
    
                    isDateFrom(date) {
                        const d = new Date(this.year, this.month, date);
    
                        return d.toDateString() === this.dateFromValue;
                    },
    
                    isDateTo(date) {
                        const d = new Date(this.year, this.month, date);
    
                        return d.toDateString() === this.dateToValue;
                    },
    
                    isInRange(date) {
                        const d = new Date(this.year, this.month, date);
    
                        return d > this.dateFrom && d < this.dateTo;
                    },
                  
                    isDisabled(date) {
                        const d = new Date(this.year, this.month, date);
    
                        if ( this.endToShow === 'from' && this.dateTo && d > this.dateTo ) {
                            return true;
                        }
                        if ( this.endToShow === 'to' && this.dateFrom && d < this.dateFrom ) {
                            return true;
                        }
    
                        return false;
                    },
                    
                    setDateValues() {
                        if (this.dateFrom) {
                            this.dateFromValue = this.dateFrom.toDateString();
                            this.dateFromYmd = this.convertToYmd(this.dateFrom);
                        }
                        if (this.dateTo) {
                            this.dateToValue = this.dateTo.toDateString();
                            this.dateToYmd = this.convertToYmd(this.dateTo);
                        }
                    },
    
                    getDateValue(date) {
                        let selectedDate = new Date(this.year, this.month, date);
                        if ( this.endToShow === 'from' && ( ! this.dateTo || selectedDate <= this.dateTo ) ) {
                            this.dateFrom = selectedDate;
                            if ( ! this.dateTo ) {
                                this.dateTo = selectedDate;
                            }
                        } else if ( this.endToShow === 'to' && ( ! this.dateFrom || selectedDate >= this.dateFrom ) ) {
                            this.dateTo = selectedDate;
                            if ( ! this.dateFrom ) {
                                this.dateFrom = selectedDate;
                            }
                        }
                        this.setDateValues();
    
                        this.closeDatepicker();
                    },
    
                    getNoOfDays() {
                        let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
    
                        // find where to start calendar day of week
                        let dayOfWeek = new Date(this.year, this.month).getDay();
                        let blankdaysArray = [];
                        for ( var i=1; i <= dayOfWeek; i++) {
                            blankdaysArray.push(i);
                        }
    
                        let daysArray = [];
                        for ( var i=1; i <= daysInMonth; i++) {
                            daysArray.push(i);
                        }
    
                        this.blankdays = blankdaysArray;
                        this.no_of_days = daysArray;
                    },
                    
                    closeDatepicker() {
                        this.endToShow = '';
                        this.showDatepicker = false;
                    }
                }
            }
        </script>
    </div>
</div>
@endsection
