@props([
    'type' => 'default', 
])

@php
    
    $color = $type === 'active' ? 'blue-2' : 'gray-3';
@endphp

<div class="h-sm p-xxxs rounded-xxxs bg-black-3">
    <x-shared.typography.label size="sm" class="text-{{ $color }}">
        {{ $slot }}
    </x-shared.typography.label>
</div>
