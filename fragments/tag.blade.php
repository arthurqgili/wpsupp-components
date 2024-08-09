@props(['color' => 'gray-3'])

<div class="h-sm px-xs rounded-xs bg-black-3">
    <x-typography.body size="md" class="text-{{ $color }}">
        {{ $slot }}
    </x-typography.body>
</div>
