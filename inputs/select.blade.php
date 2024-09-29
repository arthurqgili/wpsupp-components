@props(['options', 'selected' => null, 'placeholder' => 'Selecione uma opção', 'name' => 'select-name'])

<div x-data="{ open: false, selected: '{{ $selected }}', placeholder: '{{ $placeholder }}' }" @click.away="open = false" class="relative group">
    <div @click="open = !open"
        class="bg-transparent border font-raleway font-[400] text-[12px]  text-black-1 group-hover:border-blue-2 dark:text-white border-black-1 dark:border-white px-sm h-lg w-full flex items-center "
        :class="{ 'rounded-t-sm !border-blue-1': open, 'rounded-sm ': !open }">
        <span x-shared.text="selected ? selected : placeholder"></span>
        <div class="absolute top-0 right-0 flex items-center h-lg mr-sm">
            <span class="material-symbols-outlined !text-[12px] !leading-[125%] text-white" x-shared.show="!open">expand_more</span>
            <span class="material-symbols-outlined !text-[12px] !leading-[125%] text-white" x-shared.show="open">expand_less</span>
        </div>
    </div>

    <div x-shared.show="open" class="absolute w-full overflow-hidden border rounded-b-sm bg-black-2 border-blue-1">
        <ul class="overflow-auto max-h-60 ">
            <template x-shared.for="(option, index) in {{ json_encode($options) }}" :key="index">
                <li @click="selected = option; open = false" x-shared.text="option"
                    class="text-white flex font-raleway font-[400] text-[12px] px-sm h-lg cursor-pointer hover:bg-black-3 items-center">
                </li>
            </template>
        </ul>
    </div>

    <input type="hidden" :value="selected" name="{{ $name }}">
</div>
