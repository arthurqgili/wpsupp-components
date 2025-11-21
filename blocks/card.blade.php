@props(['size' => 'sm', 'title' => null, 'href' => null])

@php
    $tag = $href ? 'a' : 'div';
    $paddingClass = match($size) {
        'xs' => 'p-xs',
        'md' => 'p-md',
        'lg' => 'p-lg',
        default => 'p-sm',
    };
    $paddingXClass = match($size) {
        'xs' => 'px-xs',
        'md' => 'px-md',
        'lg' => 'px-lg',
        default => 'px-sm',
    };
    $paddingTClass = match($size) {
        'xs' => 'pt-xs',
        'md' => 'pt-md',
        'lg' => 'pt-lg',
        default => 'pt-sm',
    };
@endphp

<{{ $tag }} {{ $href ? "href=$href" : '' }}
    {{ $attributes->merge(['class' => 'rounded-sm bg-muted flex flex-col']) }}>
    @if (isset($title))
        <div class="{{ $paddingXClass }} {{ $paddingTClass }}">
            <x-shared.typography.body class="text-gray-2" size="md">{{ $title }}</x-shared.typography.body>
        </div>
    @endif

    <div class="{{ $paddingClass }}">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="{{ $paddingClass }}">
            {{ $footer }}
        </div>
    @endif
    </{{ $tag }}>
