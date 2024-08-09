<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('media/fav.png') }}">
    <title>{{ strip_tags($title) }} - WP Supp</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">

</head>

<body class="flex flex-col h-screen overflow-hidden dark bg-black-1" x-data="{ sidebarOpen: false, content: 'user' }">

    {{-- Apenas para teste, deve ser definido na controller de groups --}}
    {{-- @php
        $showCurrentGroupBar = true;
    @endphp --}}
    @isset($showCurrentGroupBar)
        <x-layout.currentgroupbar></x-layout.currentgroupbar>
        <div class="flex sm:grow">
            <x-layout.sidebar></x-layout.sidebar>
            <div
                class="flex flex-col grow py-md px-sm sm:p-lg gap-md sm:gap-lg overflow-auto h-[calc(100dvh-96px)] sm:h-auto sm:max-h-[calc(100dvh-32px)]">
                <x-layout.pageheader title="{!! $title !!}"></x-layout.pageheader>
                <div class="flex grow">
                    {{ $slot }}
                </div>
            </div>
        </div>
        <x-layout.mobilebottombar></x-layout.mobilebottombar>
        <x-layout.mobilesidebar></x-layout.mobilesidebar>
    @else
        <div class="flex sm:grow">
            <x-layout.sidebar></x-layout.sidebar>
            <div
                class="flex flex-col grow py-md px-sm sm:p-lg gap-md sm:gap-lg overflow-auto h-[calc(100dvh-64px)] sm:h-auto sm:max-h-screen">
                <x-layout.pageheader title="{!! $title !!}"></x-layout.pageheader>
                <div class="flex grow">
                    {{ $slot }}
                </div>
            </div>
        </div>
        <x-layout.mobilebottombar></x-layout.mobilebottombar>
        <x-layout.mobilesidebar></x-layout.mobilesidebar>
    @endisset
    @stack('scripts')
</body>

</html>
