@props([
    'type' => 'text',          // Content type: text or icon
    'text' => '',              // Text to display (if type is 'text')
    'icon' => '',              // Icon to display (if type is 'icon')
    'color' => 'bg-blue-1',       // Alert bullet color
    'hasBullet' => false,      // Whether to display the alert bullet
    'isActive' => false,       // Whether the item is active (applies blue background)
    'class' => ''              // Classes to be applied to the parent div
])


<div class="group relative cursor-pointer {{ $isActive ? 'bg-blue-1 text-white pointer-events-none' : 'bg-black-2 hover:bg-black-3' }} 
           {{ $icon ? '' : 'flex-grow' }} flex justify-center items-center px-xs py-xxs gap-xxs 
           transition-colors duration-200 {{ $class }}">
    <div class="absolute inset-0 bg-blue-hover opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>

    @if ($type === 'icon')
        <div class="flex items-center gap-xxs">
            <span class="material-symbols-outlined text-gray-3 !text-base">
                {{ $icon }}
            </span>
            @if ($hasBullet && !$isActive)
                <x-shared.fragments.alertbullet :class="$color" />
            @endif
        </div>
    @else
        <div class="flex items-center gap-xxs">
            <x-shared.typography.body size="sm" class="{{ $isActive ? 'text-white' : 'text-gray-3' }}">
                {{ $text }}
            </x-shared.typography.body>
            @if ($hasBullet && !$isActive)
                <x-shared.fragments.alertbullet :class="$color" />
            @endif
        </div>
    @endif
</div>
