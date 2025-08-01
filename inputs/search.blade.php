@props(['placeholder', 'background' => 'bg-black-2'])

<div 
    class="relative flex flex-col items-start w-full gap-xs group" 
    x-data="{ value: @entangle($attributes->wire('model')) }"
>
    <input 
        type="search" 
        {{ $attributes->whereDoesntStartWith('class') }}
        class="rounded-sm {{ $background }} font-raleway font-[400] text-[12px] placeholder-gray-3 border-none text-black-1 dark:text-white focus-visible:outline-0 px-sm h-lg w-full" 
        x-model.debounce.300ms="value" 
        placeholder="{{ $placeholder }}"
    >
    <div class="absolute top-0 right-0 flex items-center h-lg mr-sm">
        <span 
            class="material-symbols-outlined !text-[16px] !leading-[125%] text-gray-3" 
            x-show="!value"
        >
            search
        </span>
        <span 
            class="material-symbols-outlined !text-[16px] !leading-[125%] text-gray-3 cursor-pointer hover:text-blue-2" 
            x-show="value" 
            @click="value = ''"
            style="display: none;"
        >
            close
        </span>
    </div>
</div>