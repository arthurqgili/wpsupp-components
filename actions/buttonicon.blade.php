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
        $variationClass = 'bg-transparent border border-primary text-primary hover:border-primary-hover hover:text-primary-hover focus-visible:border-primary-hover focus-visible:text-primary-hover rounded-sm';
        if ($disabled) {
            $variationClass = 'bg-transparent border border-text-secondary text-muted-foreground rounded-sm';
        }
    } elseif ($variation === 'secondary') {
        $variationClass = 'bg-raised text-foreground hover:bg-primary-hover focus-visible:bg-primary-hover focus-visible:bg-primary-active focus-visible:outline-0 rounded-sm';
        if ($disabled) {
            $variationClass = 'bg-raised text-muted-foreground rounded-sm';
        }
    } else {
        $variationClass = 'bg-primary text-foreground hover:bg-primary-hover focus-visible:bg-primary-hover focus-visible:bg-primary-active focus-visible:outline-0 rounded-sm';
        if ($disabled) {
            $variationClass = 'bg-raised text-muted-foreground rounded-sm';
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
