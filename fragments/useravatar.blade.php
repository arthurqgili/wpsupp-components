@props([
    'src',                // Image source URL
    'size' => 'md',       // Avatar size ('lg', 'md', 'sm')
    'verified' => false,  // Show verified badge if true
    'fill' => false,      // Apply fill style to badge if true
    'color' => 'blue-1',  // Badge color (Tailwind class)
])

@php
    $sizeMap = [
        'lg' => 'w-12 h-12', 
        'md' => 'w-8 h-8', 
        'sm' => 'w-4 h-4', 
    ];

    $verifiedSizeMap = [
        'lg' => 16, 
        'md' => 12, 
        'sm' => null, 
    ];

    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];
    $verifiedSizeClass = $verifiedSizeMap[$size] ?? null;

    $verifiedWrapperClass = $verifiedSizeClass 
        ? "w-[$verifiedSizeClass] h-[$verifiedSizeClass]"
        : '';
@endphp

<div class="relative">
    <img src="{{ $src }}" alt="User Avatar" class="rounded-full object-cover {{ $sizeClass }}" />

    @if ($verified && $verifiedSizeClass) 
        <div class="absolute bottom-0 right-0 {{$verifiedWrapperClass}} ">
            <div class="h-2 w-2  bg-black-1 -translate-x-1/2 -translate-y-1/2"></div>
            <x-shared.fragments.icon
                type="outlined"
                color="blue-1"
                size="{{ $verifiedSizeClass }}" 
                fill
                icon="new_releases"
                class="absolute bottom-0 right-0"
            />
        </div>
    @endif
</div>
