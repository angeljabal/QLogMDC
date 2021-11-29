<button {{ $attributes->merge(['class' => 'px-4 py-2 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-700']) }}>
    {{ $slot }}
</button>
