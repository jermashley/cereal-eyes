<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="title" content="{{ config('app.name', 'Cereal Eyes') }}" />
    <meta name="description" content="Decode and encode your data with ease!" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ config('app.url', 'https://cerealeyes.me') }}" />
    <meta property="og:title" content="{{ config('app.name', 'Cereal Eyes') }}" />
    <meta property="og:description" content="Decode and encode your data with ease!" />
    <meta property="og:image" content="https://metatags.io/images/meta-tags.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ config('app.url', 'https://cerealeyes.me') }}" />
    <meta property="twitter:title" content="{{ config('app.name', 'Cereal Eyes') }}" />
    <meta property="twitter:description" content="Decode and encode your data with ease!" />
    <meta property="twitter:image" content="https://metatags.io/images/meta-tags.png" />

    <!-- Meta Tags Generated with https://metatags.io -->

    <title inertia>{{ config('app.name', '{{ config('app.name', 'Cereal Eyes') }}') }}</title>

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

<body class="font-sans antialiased dark">
    @inertia
</body>

</html>
