@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    <span class="flex items-center gap-1">
        {{ $value ?? $slot }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </span>
</label>
