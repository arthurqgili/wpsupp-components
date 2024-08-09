@if ($size === 'lg')
    <div class="{{ $attributes['class'] ?? '' }} font-raleway font-[400] text-[16px]">
        {{ $slot }}
    </div>
@elseif ($size === 'md')
    <div class="{{ $attributes['class'] ?? '' }} font-raleway font-[400] text-[12px]">
        {{ $slot }}
    </div>
@elseif ($size === 'sm')
    <div class="{{ $attributes['class'] ?? '' }} font-raleway font-[400] text-[10px]">
        {{ $slot }}
    </div>
@else
@endif
