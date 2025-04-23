@props(['size' => 'text-xs'])

<a {{ $attributes->merge(['type' => 'submit', 'class' => "$size mt-8 no-underline inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"]) }}>
    {{ $slot }}
</a>