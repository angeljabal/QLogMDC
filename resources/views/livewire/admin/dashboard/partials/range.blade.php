<div>
    <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
            <h3 class="font-semibold text-lg text-gray-900">Overview</h3>
            <h2 class="text-xs inline leading-6 text-gray-500">({{$dateStr}})</h2>
        </div>
        <div class="my-2 flex sm:flex-row flex-col">
            <div class="flex flex-row mb-1 sm:mb-0 ">
                <div class="relative">
                    <div>
                        <div class="flatpickr">
                            <input id="date-filter" type="text" placeholder="Select Date.." data-input
                                class="h-full rounded-l border block appearance-none w-full bg-white border-gray-200  text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $("#date-filter").flatpickr({
        enableTime: false,
        disableMobile: true,
        mode: "range",
        dateFormat: 'M d, Y',
        onChange: function(selectedDates, dateStr, instance){
            @this.dateRange(selectedDates, dateStr);
        }   
        });
        
    </script>
@endpush
