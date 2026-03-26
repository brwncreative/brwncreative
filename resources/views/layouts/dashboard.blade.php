<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href="{{ asset('brwncreative_mascot.svg') }}" type="image/svg">

    <title>Brwncreative Backend</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.upset.dev/css2?family=Pixelify+Sans:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- External --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="gfont">
    {{-- Main Content --}}
    {{ $slot }}
    @livewireScripts
</body>

</html>