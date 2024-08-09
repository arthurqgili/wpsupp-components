@props(['title'])

<div class="flex items-center justify-between w-full">
    <x-typography.title size="md" class="hidden text-white sm:block">{!! $title !!}</x-typography.title>
    <x-typography.title size="sm" class="block text-white sm:hidden">{!! $title !!}</x-typography.title>
    <div class="flex items-center gap-xs sm:gap-sm">
        <button
            class="flex items-center text-white select-none focus-visible:outline-0 hover:text-blue-2 focus-visible:text-blue-4">
            <span class="!text-[24px] sm:!text-[16px] !leading-[125%] material-symbols-outlined">notifications</span>
        </button>
        <x-actions.buttonlink action="" icon="group" size="sm" class="hidden sm:flex">Painel
            Pro</x-actions.buttonlink>
        <x-layout.usermenu action=""></x-layout.usermenu>
    </div>
</div>
