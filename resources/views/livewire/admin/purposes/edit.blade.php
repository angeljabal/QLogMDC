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
                                    <option value="{{ $value->id }}" {{in_array($value->id, $selectedOffices) ? 'selected' : ''}}>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('selectedOffices') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
                    </dd>
                </div>
                @if (isset($selectedOffices))
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        First Office Transaction
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <select wire:model.defer="first" class="form-input shadow border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium" name="type" id="type">
                                <option hidden="true">Choose Office</option>
                                <option selected disabled>Choose Office</option>
                                    @foreach($facilities as $value)
                                        @foreach($selectedOffices as $selected)
                                            @if($value->id == $selected)
                                                <option value="{{ $value->id }}">{{$value->name}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                            </select>
                            @error('first') <span class="mt-2 text-xs text-red-600">{{ $message }}</span>  @enderror
                        </dd>
                    </div>
                @endif
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
            @this.set('selectedOffices', $(this).val());
            console.log($(this).val());
        });
    </script>
@endpush
