<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W2GVQZPZJ5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-W2GVQZPZJ5');
    </script>


    {{-- Classic --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href="{{ asset('brwncreative_mascot.svg') }}" type="image/svg">
    <title>{{ request()->input('view') == 'web' ? 'Website and Software Services' : 'Digital Media Services' }} |
        Brwncreative </title>
    <meta name="description"
        content="Grow your business online! Professional web development, motion design, and digital media services are all at your fingertips with Brwncreative Studio.">
    <link rel="canonical" href="https://brwncreative.com/">
    <meta name="robots" content="index, follow">
    <meta name="geo.placename" content="Port of Spain">

    {{-- OG --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://brwncreative.com/">
    <meta property="og:title" content="{{ request()->input('view') == 'web' ? 'Website and Software Services' : 'Digital Media Services' }} |
        Brwncreative">
    <meta property="og:description"
        content="Grow your business online! Professional web development, motion design, and digital media services are all at your fingertips with Brwncreative Studio.">
    <meta property="og:image" content="https://brwncreative.com/brwncreative.svg">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://brwncreative.com.com/">
    <meta property="twitter:title" content="Fast-Track Your Digital Presence | Brwncreative">
    <meta property="twitter:description"
        content="Grow your business online! Professional web development, motion design, and digital media services are all at your fingertips with Brwncreative Studio.">
    <meta property="twitter:image" content="https://brwncreative.com/brwncreative.svg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Miranda+Sans:ital,wght@0,400..700;1,400..700&display=swap&display=swap&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    {{-- External --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.13.0/lottie.min.js"
        integrity="sha512-uOtp2vx2X/5+tLBEf5UoQyqwAkFZJBM5XwGa7BfXDnWR+wdpRvlSVzaIVcRe3tGNsStu6UMDCeXKEnr4IBT8gA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="gfont">
    {{-- Main Content --}}
    {{ $slot }}

    {{-- Footer --}}
    <livewire:footer defer />
    @livewireScripts
</body>

</html>