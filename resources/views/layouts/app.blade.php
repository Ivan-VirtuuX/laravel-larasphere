<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="logo.svg" type="image/svg+xml">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'Larasphere') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <header-component
        avatar-url="{{ Auth::user()->avatar_url ?? '' }}"
        login="{{ Auth::user()->name ?? '' }}"
        logout-route="{{ route('logout') }}"
        is-auth="{{ isset(Auth::user()->id) }}"
    >
    </header-component>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
