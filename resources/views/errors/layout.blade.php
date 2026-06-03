<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{ asset('assets/admin/images/logo/logo.png') }}" type="image/png">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/output.css') }}">
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
        }
        .error-page__main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.25rem;
        }
        .error-card {
            max-width: 32rem;
            width: 100%;
            text-align: center;
            background: #fff;
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        }
        .error-code {
            font-size: clamp(4rem, 18vw, 6.5rem);
            line-height: 1;
            font-weight: 700;
            color: var(--second-color, #c9a227);
            margin-bottom: 0.5rem;
        }
        .error-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 1.75rem;
        }
        .error-footer {
            text-align: center;
            padding: 1rem;
            font-size: 0.875rem;
            color: #64748b;
        }
    </style>
</head>
<body class="error-page text-gray-900">
    <header class="py-4 px-4 text-center border-bottom bg-white">
        <a href="{{ url('/') }}" class="inline-block text-decoration-none">
            <span class="fs-5 fw-bold text-main-color">{{ config('app.name', 'Visa Egypt Travel') }}</span>
        </a>
    </header>

    <main class="error-page__main">
        <div class="error-card" role="alert">
            <p class="error-code" aria-hidden="true">@yield('code')</p>
            <h1 class="h3 fw-bold text-main-color mb-3">@yield('heading')</h1>
            <p class="text-secondary mb-0">@yield('message')</p>
            <div class="error-actions">
                @yield('actions')
            </div>
        </div>
    </main>

    <footer class="error-footer">
        &copy; {{ date('Y') }} {{ config('app.name', 'Visa Egypt Travel') }}
    </footer>
</body>
</html>
