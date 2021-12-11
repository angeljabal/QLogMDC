<div>
    <div class="flex flex-wrap items-center">
        <div class="my-2 flex sm:flex-row flex-col">
            <div class="flex flex-row mb-1 sm:mb-0 ">
                <div class="relative">
                    <div>
                        <div class="flatpickr" wire:ignore>
                            <input id="date-filter" type="text" autocomplete="false" placeholder="Select Date.." data-input
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
            @this.dateRange(selectedDates);
        }   
        });
        
    </script>
@endpush
