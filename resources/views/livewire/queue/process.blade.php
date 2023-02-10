    <div>
        <div class="min-h-screen flex flex-col pt-6 sm:pt-0 p-5 bg-cyan-500 {{$hide}}">
            <div class="m-8">
                    <h1 class="font-extrabold text-white text-2xl md:text-7xl leading-tight mb-4 uppercase text-center">
                        Hello, {{auth()->user()->fname}}
                    </h1>
            </div>
            <h1 class="font-medium text-white text-5xl leading-tight mb-4 text-center">
                Select a transaction
            </h1>
            <div class="mt-2 grid grid-cols-4 gap-5">
                @foreach ($purposes as $p)
                    {{-- <a href="{{url('queue/confirm', ['purpose'=>$purpose->id])}}" onclick="javascript:document.getElementById('page-loader').style.display='block';" id="external-link" class="w-full sm:max-w-md mt-6 px-6 py-4 text-center text-2xl font-semibold bg-white shadow-md overflow-hidden sm:rounded-lg bg-gray-200">
                        <h1>{{$purpose->title}}</h1>
                    </a>  --}}
                    <button wire:click="openConfirmation({{$p->id}})" wire:key="{{'button-'.$p->id}}" class="w-full sm:max-w-md mt-6 px-6 py-4 text-center text-2xl font-semibold bg-white shadow-md overflow-hidden sm:rounded-lg bg-gray-200">
                        <h1 wire:key="{{'button-'.$p->id}}">{{$p->title}}</h1>
                    </button>
                @endforeach
            </div>
            <footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-white md:flex md:items-center md:justify-between md:p-6">
                <div class='fixed bottom-8 text-center w-full'>
                    <a href="/logout" class='my-8 ml-auto px-20 py-4 bg-red-500 text-white text-sm font-bold tracking-wide rounded-full focus:outline-none'>Cancel</a>
                </div>
            </footer>
        </div>
        @if (isset($purposeId))
            <livewire:trans-confirmation :purposeId="$purposeId" :wire:key="'purpose-'.$purposeId"/>
        @endif
    </div>

