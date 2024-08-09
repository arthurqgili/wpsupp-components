<div x-data="{ menuOpen: false }" class="relative">
    <button type="button" @click="menuOpen = !menuOpen; sidebarOpen = true; content = 'user';"
        class="flex items-center justify-center select-none text-blue-1 hover:text-blue-2 focus-visible:text-blue-4 focus-visible:outline-0 dark:text-white dark:hover:text-blue-2 dark:focus-visible:text-blue-4 gap-xxs group"
        id="usertoggle">
        <div class="flex items-center justify-center rounded-full h-md w-md sm:h-sm sm:w-sm bg-blue-1">
            <span class="!text-[16px] sm:!text-[12px] leading-[16px] material-symbols-outlined !text-white">person</span>
        </div>
        <x-typography.label class="hidden sm:flex"
            size="md">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</x-typography.label>
    </button>
    <div x-show="menuOpen" @click.away="menuOpen = false"
        class="absolute right-0 flex-col hidden text-white sm:flex mt-xs bg-black-2" id="usermenu">
        <button class="px-sm py-xs hover:bg-black-3 focus-visible:outline-0 focus-visible:bg-blue-4">
            <div class="flex items-center gap-xxs h-md">
                <span class="!text-[12px] leading-[16px] material-symbols-outlined !text-white">person</span>
                <x-typography.label size="md">Minha conta</x-typography.label>
            </div>
        </button>
        <button class="px-sm py-xs hover:bg-black-3 focus-visible:outline-0 focus-visible:bg-blue-4">
            <div class="flex items-center gap-xxs h-md">
                <span class="!text-[12px] leading-[16px] material-symbols-outlined !text-white">settings</span>
                <x-typography.label size="md">Configurações</x-typography.label>
            </div>
        </button>
        <x-inputs.form action="{{ route('logout') }}" method="POST">
            <button class="px-sm py-xs hover:bg-black-3 focus-visible:outline-0 focus-visible:bg-blue-4" type="submit">
                <div class="flex items-center gap-xxs h-md">
                    <span class="!text-[12px] leading-[16px] material-symbols-outlined !text-white">logout</span>
                    <x-typography.label size="md">Sair</x-typography.label>
                </div>
            </button>
        </x-inputs.form>
    </div>
</div>
