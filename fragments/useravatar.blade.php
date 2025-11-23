@props([
    'src',                // Image source URL
    'size' => 'md',       // Avatar size ('lg', 'md', 'sm', 'xs')
    'verified' => false,  // Show verified badge if true
    'fill' => false,      // Apply fill style to badge if true
    'color' => 'blue-1',  // Badge color (Tailwind class)
])

@php
    $sizeMap = [
        'lg' => 'w-xl h-xl', 
        'md' => 'w-lg h-lg', 
        'sm' => 'w-md h-md',
        'xs' => 'w-sm h-sm',  // Added xs size
    ];

    $verifiedSizeMap = [
        'lg' => '!text-[16px]', 
        'md' => '!text-[12px]', 
        'sm' => null,
        'xs' => null, // No verified size for xs
    ];

    $verifiedWrapperSizeMap = [
        'lg' => 'w-[16px] h-[16px]', 
        'md' => 'w-[12px] h-[12px]', 
        'sm' => null,
        'xs' => null, // No verified wrapper size for xs
    ];

    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];
    $verifiedSizeClass = $verifiedSizeMap[$size] ?? null;
    $verifiedWrapperClass = $verifiedWrapperSizeMap[$size] ?? null;
@endphp

<div class="relative shrink-0">
    <img src="{{ $src }}" alt="User Avatar" class="rounded-full object-cover {{ $sizeClass }} shrink-0" />

    {{-- Temporarily disabled - Future feature: verified client badge --}}
    {{-- @if ($verified && $verifiedSizeClass)
        <div class="absolute bottom-0 right-0 {{$verifiedWrapperClass}} flex items-center justify-center text-primary ">
            <div class="h-1/2 w-1/2 bg-white"></div>
            <x-shared.fragments.icon
                type="outlined"
                fill
                icon="new_releases"
                class="{{ $verifiedSizeClass }} absolute bottom-0 right-0"
            />
        </div>
    @endif --}}
</div>
