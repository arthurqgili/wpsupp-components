@props(['onclick', 'icon', 'size', 'type' => 'button', 'disabled' => false, 'variation' => 'primary'])

@php
    $sizeClass = '';
    $variationClass = '';

    $sizeMap = [
        'md' => 'w-lg h-lg',
        'sm' => 'w-md h-md',
        'xl' => 'w-xl h-xl',
    ];

    if (array_key_exists($size, $sizeMap)) {
        $sizeClass = $sizeMap[$size];
    }

    if ($variation === 'outlined') {
        $variationClass = 'bg-transparent border border-blue-1 text-blue-1 hover:border-blue-2 hover:text-blue-2 focus-visible:border-blue-2 focus-visible:text-blue-2 rounded-sm';
        if ($disabled) {
            $variationClass = 'bg-transparent border border-gray-3 text-gray-3 rounded-sm';
        }
    } elseif ($variation === 'secondary') {
        $variationClass = 'bg-black-3 text-white hover:bg-blue-2 focus-visible:bg-blue-2 focus-visible:bg-blue-4 focus-visible:outline-0 rounded-sm';
        if ($disabled) {
            $variationClass = 'bg-black-3 text-gray-3 rounded-sm'; 
        }
    } else {
        $variationClass = 'bg-blue-1 text-white hover:bg-blue-2 focus-visible:bg-blue-2 focus-visible:bg-blue-4 focus-visible:outline-0 rounded-sm';
        if ($disabled) {
            $variationClass = 'bg-black-3 text-gray-3 rounded-sm';  
        }
    }
@endphp

<button type="{{ $type }}"
    {{ $attributes->merge([
        'type' => $type,
        'class' => "{$variationClass} {$sizeClass} shrink-0 disabled:pointer-events-none select-none flex justify-center items-center"
    ]) }}
    @if ($disabled) disabled @endif>
    @if (!empty($icon))
        @if ($size === 'xl')
            <span class="!text-[24px] !leading-[125%] material-symbols-outlined">{{ $icon }}</span>
        @elseif ($size === 'md')
            <span class="!text-[16px] !leading-[125%] material-symbols-outlined">{{ $icon }}</span>
        @else
            <span class="!text-[12px] !leading-[125%] material-symbols-outlined">{{ $icon }}</span>
        @endif
    @endif
</button>
