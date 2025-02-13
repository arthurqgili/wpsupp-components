@props([
    'type' => 'outlined',  // Icon style ('outlined', 'rounded', 'sharp')
    'icon' => 'new_releases', // Material Symbol icon name
    'fill' => null,        // Apply fill style if true
])

<span 
    class="{{ $attributes['class'] ?? '' }} material-symbols-{{ $type }} text-blue-1 !text-[16px]"
    style="{{ $fill ? 'font-variation-settings: \'FILL\' 1;' : '' }}"
>
    {{ $icon }}
</span>
