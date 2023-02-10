<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-cyan-500 to-blue-500 p-5">
        <div class="w-full max-w-5xl px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg text-center">
            <h1 class="font-extrabold text-cyan-800 text-2xl md:text-7xl leading-tight mb-4 uppercase text-center">
                Transaction Complete
            </h1>
            <div class="border-t border-gray-200 py-4">
                <h1 class="font-extralight text-black text-2xl leading-tight text-center">
                    You are currently in the queue.
                </h1>
                <h1 class="font-extrabold text-black text-8xl leading-tight mb-4 text-center">
                    Queue Number: {{sprintf('%03d', $log->queue_no)}}
                </h1>
                <h1 class="font-extralight text-black text-2xl leading-tight">
                    {{$log->created_at}}
                </h1>
            </div>
            <div class="border-t border-gray-200 py-4">
                
                <h1 class="font-extralight text-black text-2xl leading-tight">
                    **Valid only until today**
                </h1>
            </div>
        </div>
    </div>
    <footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-white md:flex md:items-center md:justify-between md:p-6">
        <div class='fixed bottom-8 text-center w-full'>
            <a href="/logout" class='y-8 ml-auto px-20 py-4 bg-green-700 text-white text-sm font-bold tracking-wide rounded-full focus:outline-none'>Done</a>
        </div>
    </footer>
</x-guest-layout>