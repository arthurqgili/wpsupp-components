@if ($size === 'lg')
    <div class="{{ $attributes['class'] ?? '' }} font-raleway font-[800] text-[48px]">
        {{ $slot }}
    </div>
@elseif ($size === 'md')
    <div class="{{ $attributes['class'] ?? '' }} font-raleway font-[700] text-[40px]">
        {{ $slot }}
    </div>
@else
@endif
