@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-3 text-sm font-medium text-gray-900 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
