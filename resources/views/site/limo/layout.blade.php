<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Limo')</title>
    <base href="{{ rtrim(asset('assets/site/limo'), '/') }}/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/output.css">
    @stack('head')
</head>
<body @yield('body_attributes')>
@yield('content')
@stack('scripts')
</body>
</html>
