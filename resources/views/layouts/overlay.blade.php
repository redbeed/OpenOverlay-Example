<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-transparent">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OpenOverlay Overlay Example') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/overlay.js') }}" defer></script>
</head>
<body class="screen-1920x1080 bg-transparent" data-twitch-user="{{ $twitchUserId }}">
    @yield('content')

    <script src="https://kit.fontawesome.com/d91f89b759.js" crossorigin="anonymous"></script>
</body>
</html>
