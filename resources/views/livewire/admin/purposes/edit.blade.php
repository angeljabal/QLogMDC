<div>
    <div class="bg-white mt-10 m-20">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Purpose Information
            </h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Full name
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      <x-input wire:model.defer="title" type="text" value="{{ $this->purpose->title }}"/>
                      @error('title') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Facility
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <div wire:ignore>
                            <select
                                    class="js-example-basic-multiple" style="width: 100%" 
                                    data-placeholder="Select facilities..."
                                    data-allow-clear="false"
                                    multiple="multiple"
                                    id="facilities"
                                    title="Select facility...">
                                @foreach ($facilities as $value)
                                    <option value="{{ $value->id }}" {{in_array($value->id, $facilityIds) ? 'selected' : ''}}>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('facilityIds') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
                    </dd>
                </div>
                <div class="flex justify-end text-center bg-white px-8 py-5">
                    <button wire:click="submit" class="p-4 m-1 text-sm text-white bg-cyan-400 rounded-md hover:bg-cyan-600">Update</button>
                    <x-buttons.secondary class="p-4 m-1 text-sm" wire:click="back">{{ __('Back') }}</x-buttons.secondary>
                </div>
            </dl>
        </div>
    </div>
</div>
@push('js')
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('.selectpicker').select2();
        });
    </script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        $('#facilities').on('change', function(){
            @this.set('facilityIds', $(this).val());
            console.log($(this).val());
        });
    </script>
@endpush