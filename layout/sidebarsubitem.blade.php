@props(['isActive' => false])

<button
    class=" focus-visible:outline-0 text-white hover:text-gray-3 focus-visible:text-blue-4 select-none flex items-center h-md  {{ $isActive ? '!text-blue-1 pointer-events-none' : '' }}">
    <x-typography.label size="md">
        {{ $slot }}
    </x-typography.label>
</button>
