<a href="{{route('login')}}" {{ $attributes->merge(['class' => ' px-4 py-2 bg-gray-800 dark:bg-none border rounded-md font-semibold text-xs text-white uppercase tracking-widest ']) }}>
    {{ $slot }}
</a>
