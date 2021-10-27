<button {{ $attributes->merge(['class' => 'p-4 m-1 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-700']) }}>
    {{ $slot }}
</button>
