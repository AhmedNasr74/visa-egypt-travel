<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {!! SEO::generate(true) !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ icon() }}" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="{{ icon() }}">

    <!-- Additional plugin css -->

    <!-- Box icon -->
    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet"
    />
    <!-- flowbit plugin -->
    <link
        href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
        rel="stylesheet"
    />
    <!-- owl carousel slider -->

    <!-- progress circle -->
    <link rel="stylesheet" href="{{asset("assets/site/css/progresscircle.css")}}"/>
    <!-- aos animate -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
    <!-- star rating -->
    <link rel="stylesheet" href="{{asset("assets/site/css/star-rating-svg.css")}}"/>
    <link rel="stylesheet" href="{{ asset('assets/site/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/all.min.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('assets/site/css/jquery-ui.min.css') }}">--}}
    <!-- icons -->
    {{--    <link rel="stylesheet" href="{{ asset('assets/site/css/themify-icons.css') }}">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    {{--    <link rel="stylesheet" href="{{ asset('assets/site/css/jquery.timepicker.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap.min.css') }}">

    {{--    <link rel="stylesheet" href="{{ asset('assets/site/css/toastr.min.css') }}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{asset("assets/site/css/owl.carousel.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/site/css/owl.theme.default.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/site/css/aos.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/site/css/output.css")}}"/>
    @stack('css')
    <style>
        .main-menu, .topHead {
            background-color: #fff;
        }

        .whatsapp-btn {
            display: inline-flex;
            align-items: center;
            background: #25D366;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .main-menu {
            position: sticky;
            left: 0;
            top: 0;
            z-index: 999;
        }
        .custom-select2,.select2-container {
            width: 100% !important;
        }
        footer {
            overflow-x: hidden;
        }
    </style>
    <style>
        {!! setting(\App\Enums\SettingKey::CUSTOM_CSS->value, true) !!}
    </style>
</head>
