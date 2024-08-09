<div class="flex flex-col items-stretch self-stretch gap-xs">
    <x-layout.sidebaritem href="{{ route('home') }}" :is-active="request()->routeIs('home')" icon="home"
        text="Dashboard"></x-layout.sidebaritem>
    <x-layout.sidebaritem href="{{ route('tickets') }}" :is-active="request()->routeIs('tickets')" icon="confirmation_number"
        text="Tickets"></x-layout.sidebaritem>
    <x-layout.sidebaritem href="" icon="select_window" text="Sites"></x-layout.sidebaritem>
    <x-layout.sidebaritem href="" icon="schedule" text="Histórico"></x-layout.sidebaritem>
    {{-- Example for future use  --}}
    <x-layout.sidebaritem href="" :active-routes="['home']" icon="settings" text="Dashboard">
        <x-layout.sidebarsubitem href="" :is-active="request()->routeIs('home')">Dashboard</x-layout.sidebarsubitem>
        <x-layout.sidebarsubitem href="">Item 2</x-layout.sidebarsubitem>
    </x-layout.sidebaritem>
    <x-layout.sidebaritem href="" :active-routes="['']" icon="settings" text="Outros">
        <x-layout.sidebarsubitem href="">Item 1</x-layout.sidebarsubitem>
        <x-layout.sidebarsubitem href="">Item 2</x-layout.sidebarsubitem>
    </x-layout.sidebaritem>
    <x-layout.sidebaritem href="" :active-routes="['']" icon="settings" text="Mais">
        <x-layout.sidebarsubitem href="">Item 3</x-layout.sidebarsubitem>
        <x-layout.sidebarsubitem href="">Item 4</x-layout.sidebarsubitem>
    </x-layout.sidebaritem>
</div>
