<div id="sidebaroverlay" class="fixed w-screen h-screen duration-500 ease-in-out opacity-0 sm:hidden bg-black-1"
    :class="sidebarOpen ? '!opacity-50' : 'opacity-0 pointer-events-none'" @click="sidebarOpen = false" x-cloak></div>
<div id="mobilesidebar"
    class="flex-col items-start flex bg-black-2 px-sm py-lg w-[66%] fixed h-screen ease-in-out duration-500 sm:hidden opacity-0"
    :class="sidebarOpen ? 'right-0 opacity-100' : 'opacity-100 right-[-100%]'" x-cloak>
    <div id="sidebarmenucontent" class="flex flex-col items-start w-full gap-lg" x-show="content === 'menu'">
        <img class="object-contain h-lg" src="{{ asset('media/logo-white.png') }}" alt="WP Supp">
        <x-layout.sidebarmenu></x-layout.sidebarmenu>
    </div>
    <div id="sidebarusercontent" class="flex flex-col items-start w-full gap-lg" x-show="content === 'user'">
        <div class="flex flex-col text-white gap-xxs">
            <x-typography.title
                size="sm">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</x-typography.title>
            <x-typography.body size="md">{{ Auth::user()->username }}</x-typography.body>
        </div>
        <div class="flex flex-col self-stretch gap-xs">
            <x-layout.sidebaritem action="" icon="person" text="Minha conta"></x-layout.sidebaritem>
            <x-layout.sidebaritem action="" icon="settings" text="Configurações"></x-layout.sidebaritem>
            <x-inputs.form action="{{ route('logout') }}" method="POST">
                <x-layout.sidebaritem type="submit" action="" icon="logout"
                    text="Sair"></x-layout.sidebaritem>
            </x-inputs.form>
        </div>
    </div>
</div>
