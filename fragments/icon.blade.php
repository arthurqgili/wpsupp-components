@props([
    'type' => 'outlined',  // Icon style ('outlined', 'rounded', 'sharp')
    'color' => 'blue-1',   // Icon color (e.g., Tailwind color class)
    'size' => '16',        // Icon size in pixels
    'icon' => 'new_releases', // Material Symbol icon name
    'fill' => null,        // Apply fill style if true
    'class' => '',         // Additional custom classes
])

<span 
    class="material-symbols-{{ $type }} text-{{ $color }} !text-[{{ $size }}px] {{ $class }}"
    style="{{ $fill ? 'font-variation-settings: \'FILL\' 1;' : '' }}"
>
    {{ $icon }}
</span>
