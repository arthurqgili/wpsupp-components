@props([
    'type' => 'outlined',  // Icon style ('outlined', 'rounded', 'sharp')
    'icon' => 'new_releases', // Material Symbol icon name
    'fill' => null,        // Apply fill style if true
])

<span 
    class="{{ $attributes['class'] ?? '' }} material-symbols-{{ $type }}"
    style="{{ $fill ? 'font-variation-settings: \'FILL\' 1;' : '' }}"
>
    {{ $icon }}
</span>
