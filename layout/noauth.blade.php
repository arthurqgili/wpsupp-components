<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('media/fav.png') }}">
    <title>{{ $title }} - WP Supp</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">

</head>

<body class="flex flex-col h-screen dark bg-black-1">
    <x-layout.navbar></x-layout.navbar>
    <div class="flex justify-center grow">
        {{ $slot }}
    </div>
</body>

</html>
