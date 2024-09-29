@props(['color' => 'gray-3'])

<div class="h-sm px-xs rounded-xs bg-black-3">
    <x-shared.typography.body size="md" class="text-{{ $color }}">
        {{ $slot }}
    </x-shared.typography.body>
</div>
