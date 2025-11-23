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
        $activeClasses = 'text-primary dark:text-primary pointer-events-none';
    } else {
        $activeClasses = 'text-muted-foreground dark:text-muted-foreground hover:text-foreground dark:hover:text-foreground focus-visible:text-primary focus-visible:border-b focus-visible:border-primary focus-visible:outline-0 dark:focus-visible:text-primary dark:focus-visible:border-primary';
    }

    $disabledClasses = 'disabled:pointer-events-none disabled:text-muted-foreground';

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
