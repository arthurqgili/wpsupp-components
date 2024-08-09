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
    class="{{ $attributes['class'] ?? '' }} whitespace-nowrap text-blue-1 border border-blue-1 hover:border-blue-2 hover:text-blue-2 dark:text-white focus-visible:border-blue-4 focus-visible:text-blue-4 dark:border-white dark:focus-visible:border-blue-4 dark:focus-visible:text-blue-4 dark:hover:border-blue-2 dark:hover:text-blue-2 focus-visible:outline-0 rounded-sm {{ $sizeClass }} disabled:pointer-events-none disabled:border-gray-3 disabled:text-gray-3 select-none flex justify-center items-center"
    @isset($onclick) onclick="{{ $onclick }}" @endisset
    @if ($disabled) disabled @endif>
    @if (!empty($icon))
        @if ($size === 'md')
            <span class="!text-[16px] !leading-[125%] material-symbols-outlined mr-xxs">{{ $icon }}</span>
        @else
            <span class="!text-[12px] !leading-[125%] material-symbols-outlined mr-xxs">{{ $icon }}</span>
        @endif
    @endif

    <x-typography.label :size="$size === 'md' ? 'lg' : 'md'">
        {{ $slot }}
    </x-typography.label>
</button>
