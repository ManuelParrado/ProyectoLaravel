@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-3 text-sm font-medium text-gray-200']) }}>
    {{ $value ?? $slot }}
</label>
