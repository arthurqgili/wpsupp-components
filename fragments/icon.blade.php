@props([
    'type' => 'outlined',
    'color' => 'blue-1',
    'size' => '16',
    'icon' => 'new_releases',
    'fill' => null,
    'class' => '', 
])

<span 
    class="material-symbols-{{ $type }} text-{{ $color }} !text-[{{ $size }}px] {{ $class }}"
    style="{{ $fill ? 'font-variation-settings: \'FILL\' 1;' : '' }}"
>
    {{ $icon }}
</span>
