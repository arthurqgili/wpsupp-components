@if ($size === 'lg')
    <div class="{{ $attributes['class'] ?? '' }} font-raleway font-[600] text-[32px]">
        {{ $slot }}
    </div>
@elseif ($size === 'md')
    <div class="{{ $attributes['class'] ?? '' }} font-raleway font-[600] text-[24px]">
        {{ $slot }}
    </div>
@elseif ($size === 'sm')
    <div class="{{ $attributes['class'] ?? '' }} font-raleway font-[600] text-[20px]">
        {{ $slot }}
    </div>
@else
@endif
