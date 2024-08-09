<div class="flex justify-stretch sm:hidden bg-black-2">
    <a href="{{ route('home') }}" class="flex justify-center py-sm grow">
        <span
            class="!text-[32px] !leading-[100%] material-symbols-outlined {{ Route::currentRouteName() == 'home' ? 'text-blue-1' : 'text-white' }}">home</span>
    </a>
    <a href="{{ route('tickets') }}" class="flex justify-center py-sm grow">
        <span
            class="!text-[32px] !leading-[100%] material-symbols-outlined  {{ Route::currentRouteName() == 'tickets' ? 'text-blue-1' : 'text-white' }}">confirmation_number</span>
    </a>
    <a @click="sidebarOpen = true; content = 'menu';" class="flex justify-center py-sm grow">
        <span class="!text-[32px] !leading-[100%] material-symbols-outlined text-white">menu</span>
    </a>
</div>
