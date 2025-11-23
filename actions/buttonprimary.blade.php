@props(['onclick', 'click', 'icon', 'size', 'type' => 'button', 'disabled' => false])

@php
    $sizeClass = '';

    $sizeMap = [
        'md' => 'px-sm h-lg',
        'sm' => 'px-xs h-md',
    ];

    if (array_key_exists($size, $sizeMap)) {
        $sizeClass = $sizeMap[$size];
    }
@endphp

<button type="{{ $type }}"
    class="{{ $attributes['class'] ?? '' }} whitespace-nowrap bg-primary hover:bg-primary-hover focus-visible:bg-primary-hover focus-visible:bg-blue-4 focus-visible:outline-0 text-foreground rounded-sm {{ $sizeClass }} disabled:pointer-events-none disabled:bg-gray-3 select-none flex justify-center items-center"
    @isset($onclick) onclick="{{ $onclick }}" @endisset
    @isset($click) @click="{{ $click }}" @endisset
    @if ($disabled) disabled @endif
    {{ $attributes->except(['class', 'onclick', 'click', 'type', 'disabled', 'icon', 'size']) }}
>
    @if (!empty($icon))
        @if ($size === 'md')
            <span class="!text-[16px] !leading-[125%] material-symbols-outlined mr-xxs">{{ $icon }}</span>
        @else
            <span class="!text-[12px] !leading-[125%] material-symbols-outlined mr-xxs">{{ $icon }}</span>
        @endif
    @endif

    <x-shared.typography.label :size="$size === 'md' ? 'lg' : 'md'">
        {{ $slot }}
    </x-shared.typography.label>
</button>
