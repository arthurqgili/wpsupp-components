@props(['pagequery', 'totalquery', 'page' => '1'])

<div {{ $attributes->merge([
    'class' => 'flex gap-sm items-center',
]) }}>
    <x-typography.label class="text-gray-3" size='md'>{{ $pagequery }} de {{ $totalquery }}</x-typography.label>
    <div class="flex items-center gap-xxs">
        <x-actions.buttonicon icon="arrow_left_alt" size="sm" :disabled="$page <= 1"></x-actions.buttonicon>
        <div class="flex items-center justify-center border rounded-sm pointer-events-none h-md w-md border-black-3">
            <x-typography.label class="text-white" size='md'>{{ $page }}</x-typography.label>
        </div>
        <x-actions.buttonicon icon="arrow_right_alt" size="sm"></x-actions.buttonicon>
    </div>
</div>
