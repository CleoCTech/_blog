<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="shortcut icon" href="/storage/general/favicon.png"/>
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
