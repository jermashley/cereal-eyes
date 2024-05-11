<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Cereal Eyes') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite([
    'resources/js/app.js',
    'resources/css/app.css',
    "resources/js/Pages/{$page['component']}.vue"
    ])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
