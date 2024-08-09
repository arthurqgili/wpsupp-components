<div class="flex items-center text-white h-lg px-sm sm:pl-sm sm:pr-lg bg-blue-1">
    <div class="justify-between hidden w-full sm:flex">
        <div class="flex items-center gap-xxs">
            <span class="!text-[12px] !leading-[16px] material-symbols-outlined">group</span>
            <x-typography.body size="md">Você está gerenciando:</x-typography.body>
            <x-typography.label size="md">{ Groupname }</x-typography.label>
        </div>
        <x-actions.buttonlink action="" icon="arrow_right_alt" size="sm">Sair</x-actions.buttonlink>
    </div>
    <div class="flex justify-between w-full sm:hidden">
        <div class="flex items-center gap-xxs">
            <span class="!text-[16px] !leading-[16px] material-symbols-outlined">group</span>
            <x-typography.label size="lg">{ Groupname }</x-typography.label>
        </div>
        <x-actions.buttonlink action="" icon="arrow_right_alt" size="md">Sair</x-actions.buttonlink>
    </div>
</div>
