@props(['src', 'size' => 'md', 'verified' => false, 'fill' => false, 'color' => 'blue-1', 'icon' => 'new_releases'])

@php
    $sizeMap = [
        'lg' => 'w-12 h-12', 
        'md' => 'w-8 h-8', 
        'sm' => 'w-4 h-4', 
    ];

    $verifiedSizeMap = [
        'lg' => 16, 
        'md' => 12, 
        'sm' => 8, 
    ];

    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];
    $verifiedSizeClass = $verifiedSizeMap[$size] ?? $verifiedSizeMap['md'];
@endphp

<div class="relative">
    <img src="{{ $src }}" alt="User Avatar" class="rounded-full object-cover {{ $sizeClass }}" />

    @if ($verified)
        <x-shared.fragments.icon
            type="outlined"
            color="blue-1"
            size="{{ $verifiedSizeClass }}" 
            fill
            icon="new_releases"
            class="absolute bottom-0 right-0"
        />
    @endif
</div>
