<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, follow">

    <!-- Favicon -->
    <link rel="icon" href="logo.svg" type="image/svg+xml">

    <title>Страница не найдена</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<div class="not-found-page-block d-flex align-items-center justify-content-center">
    <div class="d-flex flex-column align-items-center">
        <p class="not-found-page-block-title fw-bold text-danger">Ошибка 404</p>
        <p class="not-found-page-block-desc text-secondary">Страница по адресу <span
                class="text-primary">"/{{ request()->path() }}"</span> не
            найдена</p>
    </div>
</div>
</body>

</html>
