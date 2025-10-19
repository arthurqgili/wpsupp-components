@props(['onclick', 'click', 'icon', 'size', 'type' => 'button', 'disabled' => false, 'href' => null, 'active' => false])

@php
    $sizeClass = '';

    $sizeMap = [
        'md' => 'h-lg',
        'sm' => 'h-md',
    ];

    if (array_key_exists($size, $sizeMap)) {
        $sizeClass = $sizeMap[$size];
    }

    $tag = $href ? 'a' : 'button';

    $baseClasses = 'whitespace-nowrap select-none flex items-center ' . $sizeClass;

    if ($active) {
        $activeClasses = 'text-blue-1 dark:text-blue-1 pointer-events-none';
    } else {
        $activeClasses = 'text-blue-1 dark:text-white hover:text-blue-2 dark:hover:text-blue-2 focus-visible:text-blue-4 focus-visible:border-b focus-visible:border-blue-4 focus-visible:outline-0 dark:focus-visible:text-blue-4 dark:focus-visible:border-blue-4';
    }

    $disabledClasses = 'disabled:pointer-events-none disabled:text-gray-3';

    $finalClasses = $baseClasses . ' ' . $activeClasses . ' ' . $disabledClasses;
@endphp

<{{ $tag }} {{ $href ? "href=$href" : '' }}
    {{ $attributes->merge([
        'class' => $finalClasses,
    ]) }}
    @isset($onclick) onclick="{{ $onclick }}" @endisset
    @isset($click) @click="{{ $click }}" @endisset
    @if ($disabled) disabled @endif>

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

    </{{ $tag }}>
