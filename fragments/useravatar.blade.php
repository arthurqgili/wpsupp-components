@props(['src', 'size' => 'md', 'verified' => false])

@php
    // Size mapping for the avatar
    $sizeMap = [
        'lg' => 'w-12 h-12',   // 48px (Large size)
        'md' => 'w-8 h-8',     // 32px (Medium size)
        'sm' => 'w-4 h-4',     // 16px (Small size)
    ];

    // Size mapping for the verified icon based on the avatar size
    $verifiedSizeMap = [
        'lg' => '!text-[16px]',   // For 48px avatar
        'md' => '!text-[12px]',    // For 32px avatar
        'sm' => '!text-[8px]',    // For 16px avatar
    ];

    // Check if the provided size is valid and assign the corresponding class
    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];  // Default to 'md' if the size is not valid
    $verifiedSizeClass = $verifiedSizeMap[$size] ?? $verifiedSizeMap['md'];  // Default to 'md' if the size is not valid
@endphp

<div class="relative">
    {{-- Avatar image --}}
    <img src="{{ $src }}" alt="User Avatar" class="rounded-full object-cover {{ $sizeClass }}" />

    {{-- Verified icon --}}
    @if ($verified)
        <span class="material-symbols-outlined absolute bottom-0 right-0 {{ $verifiedSizeClass }} text-blue-1">new_releases</span>
    @endif
</div>
