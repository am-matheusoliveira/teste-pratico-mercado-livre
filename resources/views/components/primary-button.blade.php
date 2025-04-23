@props(['size' => 'text-xs'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "$size inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-white tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</button>
