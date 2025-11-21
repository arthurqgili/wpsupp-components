@props([
    'type' => 'outlined',  // Icon style ('outlined', 'rounded', 'sharp')
    'icon' => 'new_releases', // Material Symbol icon name
    'fill' => null,        // Apply fill style if true
])

@php
    $typeClass = match($type) {
        'rounded' => 'material-symbols-rounded',
        'sharp' => 'material-symbols-sharp',
        default => 'material-symbols-outlined',
    };
@endphp

<span
    class="{{ $attributes['class'] ?? '' }} {{ $typeClass }}"
    style="{{ $fill ? 'font-variation-settings: \'FILL\' 1;' : '' }}"
>
    {{ $icon }}
</span>
