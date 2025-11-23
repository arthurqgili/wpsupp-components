@props(['onclick', 'icon', 'size', 'type' => 'button', 'disabled' => false, 'mode' => 'light'])

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
    class="{{ $attributes['class'] ?? '' }} whitespace-nowrap text-primary border border-primary hover:border-primary-hover hover:text-primary-hover dark:text-foreground focus-visible:border-primary-active focus-visible:text-primary-active dark:border-foreground dark:focus-visible:border-primary-active dark:focus-visible:text-primary-active dark:hover:border-primary-hover dark:hover:text-primary-hover focus-visible:outline-0 rounded-sm {{ $sizeClass }} disabled:pointer-events-none disabled:border-text-secondary disabled:text-muted-foreground select-none flex justify-center items-center"
    @isset($onclick) onclick="{{ $onclick }}" @endisset
    @if ($disabled) disabled @endif
    {{ $attributes->except(['class', 'onclick', 'type', 'disabled', 'icon', 'size', 'mode']) }}
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
