@props(['href' => null, 'icon', 'text', 'activeRoutes' => []])

@php
    $isActive = $isActive ?? in_array(request()->route()->getName(), $activeRoutes);
@endphp

<div x-data="{ activeItem: '{{ $isActive ? $text : null }}' }" class="flex flex-col sidebaritem gap-xs">
    <a @click="activeItem = (activeItem === '{{ $text }}') ? null : '{{ $text }}'"
        class="toggle focus-visible:outline-0 cursor-pointer text-white hover:text-gray-3 focus-visible:text-blue-4 select-none flex items-center justify-between h-lg {{ $isActive ? 'active !text-blue-1 pointer-events-none' : '' }}"
        @if ($href) href="{{ $href }}" @endif>
        <div class="flex items-center">
            <span class="!text-[16px] !leading-[125%] material-symbols-outlined mr-xxs">{{ $icon }}</span>
            <x-typography.label size="lg">
                {{ $text }}
            </x-typography.label>
        </div>
        @unless (empty(trim($slot)))
            <span class="expand-icon !text-[16px] !leading-[125%] material-symbols-outlined"
                x-text="(activeItem === '{{ $text }}') ? 'expand_less' : 'expand_more'"></span>
        @endunless
    </a>
    @unless (empty(trim($slot)))
        <div x-show="(activeItem === '{{ $text }}' || '{{ request()->route()->getName() }}' === '{{ $activeRoutes[0] ?? '' }}')"
            class="flex submenu pl-sm">
            <div class="flex flex-col w-full gap-xs px-xxs">
                {{ $slot }}
            </div>
        </div>
    @endunless
</div>
