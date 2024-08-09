@props(['onclick', 'icon', 'size', 'type' => 'button', 'disabled' => false])

@php
    $sizeClass = '';

    $sizeMap = [
        'md' => 'w-lg h-lg',
        'sm' => 'w-md h-md',
    ];

    if (array_key_exists($size, $sizeMap)) {
        $sizeClass = $sizeMap[$size];
    }
@endphp

<button type="{{ $type }}"
    class="{{ $attributes['class'] ?? '' }} shrink-0 bg-blue-1 hover:bg-blue-2 focus-visible:bg-blue-2 focus-visible:bg-blue-4 focus-visible:outline-0 text-white rounded-sm {{ $sizeClass }} disabled:pointer-events-none disabled:bg-black-3 select-none flex justify-center items-center"
    @isset($onclick) onclick="{{ $onclick }}" @endisset
    @if ($disabled) disabled @endif>
    @if (!empty($icon))
        @if ($size === 'md')
            <span class="!text-[16px] !leading-[125%] material-symbols-outlined">{{ $icon }}</span>
        @else
            <span class="!text-[12px] !leading-[125%] material-symbols-outlined">{{ $icon }}</span>
        @endif
    @endif
</button>
