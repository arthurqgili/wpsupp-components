@props(['pagequery', 'totalquery', 'page' => '1'])

<div {{ $attributes->merge([
    'class' => 'flex gap-sm items-center',
]) }}>
    <x-shared.typography.label class="text-gray-3" size='md'>{{ $pagequery }} de {{ $totalquery }}</x-shared.typography.label>
    <div class="flex items-center gap-xxs">
        <x-shared.actions.buttonicon icon="arrow_left_alt" size="sm" :disabled="$page <= 1"></x-shared.actions.buttonicon>
        <div class="flex items-center justify-center border rounded-sm pointer-events-none h-md w-md border-black-3">
            <x-shared.typography.label class="text-white" size='md'>{{ $page }}</x-shared.typography.label>
        </div>
        <x-shared.actions.buttonicon icon="arrow_right_alt" size="sm"></x-shared.actions.buttonicon>
    </div>
</div>
