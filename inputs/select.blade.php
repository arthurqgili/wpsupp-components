@props([
    'options', 
    'selected' => null, 
    'placeholder' => 'Selecione uma opção', 
    'name' => 'select-name', 
    'variation' => 'default', 
    'open' => false, 
    'background' => 'bg-black-2',  // Prop de fundo com valor padrão
])

<div x-data="{ open: false, selected: '{{ $selected }}', placeholder: '{{ $placeholder }}' }" @click.away="open = false" class="relative group select-none">
    <!-- Default -->
    @if ($variation === 'default')
        <div @click="open = !open"
            class="bg-transparent border font-raleway font-[400] text-[12px] text-black-1 group-hover:border-blue-2 dark:text-white border-black-1 dark:border-white px-sm h-lg w-full flex items-center"
            :class="{ 'rounded-t-sm !border-blue-1': open, 'rounded-sm ': !open }">
            <span x-text="selected ? selected : placeholder" class="text-xs"></span>
            <div class="absolute top-0 right-0 flex items-center h-lg mr-sm">
                <span class="material-symbols-outlined !text-[12px] !leading-[125%] text-white" x-show="!open">expand_more</span>
                <span class="material-symbols-outlined !text-[12px] !leading-[125%] text-white" x-show="open">expand_less</span>
            </div>
        </div>

        <div x-show="open" class="absolute w-full overflow-hidden border rounded-b-sm bg-black-2 border-blue-1">
            <ul class="overflow-auto max-h-60">
                <template x-for="(option, index) in {{ json_encode($options) }}" :key="index">
                    <li @click="selected = option; open = false" x-text="option"
                        class="text-white flex font-raleway font-[400] text-[12px] px-sm h-lg cursor-pointer hover:bg-black-3 items-center">
                    </li>
                </template>
            </ul>
        </div>

    <!-- WW Variation -->
    @elseif ($variation === 'ww')
        <div @click="open = !open"
            class="font-raleway font-[400] text-[12px] text-white dark:text-white px-sm h-lg w-full flex items-center cursor-pointer {{ $open ? 'rounded-sm' : 'rounded-t-sm' }} 
            {{ $background }}">
            <span x-text="selected ? selected : placeholder" class="text-xs"></span>
            <div class="absolute top-0 right-0 flex items-center h-lg mr-sm">
                <span class="material-symbols-outlined !text-[12px] !leading-[125%] text-white" x-show="!open">expand_more</span>
                <span class="material-symbols-outlined !text-[12px] !leading-[125%] text-white" x-show="open">expand_less</span>
            </div>
        </div>

        <div x-show="open" class="absolute z-50 w-full overflow-hidden border rounded-b-sm bg-black-2 border-transparent">
            <ul class="overflow-auto max-h-60">
                <template x-for="(option, index) in {{ json_encode($options) }}" :key="index">
                    <li @click="selected = option; open = false" x-text="option"
                        class="text-white flex font-raleway font-[400] text-[12px] px-sm h-lg cursor-pointer hover:bg-black-3 items-center">
                    </li>
                </template>
            </ul>
        </div>
    @endif

    <!-- Hidden Input -->
    <input type="hidden" :value="selected" name="{{ $name }}">
</div>
