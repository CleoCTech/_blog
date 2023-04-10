<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{config('app.metaDescription')}}" />
        <meta name="author" content="{{config('app.company')['name']}}" />
        <!-- Facebook, Whatsapp -->
        <meta property="og:site_name" content="Daily Notifications™" head-key="og:site_name">
        <meta property="og:title" content="" head-key="og:title">
        <meta property="og:description" content="" head-key="og:description">
        <meta property="og:image" content="" head-key="og:image">
        <meta property="og:url" content="" head-key="og:url">

        <!-- Twitter -->
        <meta name="twitter:title" content="Daily Notifications website and Blog" head-key="twitter:title">
        <meta name="twitter:description" content="Articles on various categories written by Daily Notifications™" head-key="twitter:description">
        <meta name="twitter:image" content="logo.png" head-key="twitter:image">
        <meta property="twitter:url" content="https//www.dailynotifications.com" head-key="twitter:url">
        <meta name="twitter:card" content="summary" head-key="twitter:card">
    
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="shortcut icon" href="/storage/general/DNS_2.svg"/>
        {{-- <link rel="shortcut icon" href="/storage/general/favicon.ico"/> --}}
        {{-- <link rel="stylesheet" href="/resources/css/ck-editor.css"> --}}

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/a9605f81ae.js" crossorigin="anonymous"></script>
        @routes
        {{-- @vite(['resources/js/app.js', "resources/js/Guest/{$page['component']}.vue"]) --}}
        @vite(['resources/css/ck-editor.css', 'resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="bg-gray-900">
        @inertia
    </body>
</html>
