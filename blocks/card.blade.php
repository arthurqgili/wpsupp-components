@props(['size' => 'sm', 'title' => null, 'href' => null])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }} {{ $href ? "href=$href" : '' }}
    {{ $attributes->merge(['class' => 'rounded-sm bg-black-2 flex flex-col']) }}>
    @if (isset($title))
        <div class="px-{{ $size }} pt-{{ $size }}">
            <x-shared.typography.body class="text-gray-2" size="md">{{ $title }}</x-shared.typography.body>
        </div>
    @endif

    <div class="p-{{ $size }}">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="p-{{ $size }}">
            {{ $footer }}
        </div>
    @endif
    </{{ $tag }}>
