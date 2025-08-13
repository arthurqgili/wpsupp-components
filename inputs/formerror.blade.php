@props(['message' => ''])
@if ($message)
    <x-shared.typography.label class="text-red-1" size="md">
        {{ $message }}
    </x-shared.typography.label>
@endif