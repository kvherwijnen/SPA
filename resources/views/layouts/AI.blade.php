<!doctype html>

@if(env('APP_ENV') === 'public')
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" manifest="{{ url('appcache/manifest.appcache') }}">
    @else
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        @endif

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=no">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="robots" content="index, follow, noodp, noydir"/>

            <meta property="og:title" content="Artificial Intelligence"/>
            <meta property="og:site_name" content="{{ config('app.name', 'Sheep Default app') }}"/>
            <meta property="og:type" content="application/website"/>
            <meta property="og:url" content="{{ url()->current() }}"/>
            <meta property="og:image" content="{{ asset('assets/img/icons/apple-icon-180x180.png') }}"/>

            <meta name="description"
                  content="De sheeps zijn bezig met hun nieuwe AI en beginnen vorderingen te maken, prepare neefjes!">
            <meta name="og:description"
                  content="De sheeps zijn bezig met hun nieuwe AI en beginnen vorderingen te maken, prepare neefjes!">

            <link rel="canonical" href="{{ url()->current() }}"/>
            <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

            <link rel="manifest" href="{{ mix('assets/manifest.json') }}" crossorigin="use-credentials">
            <link rel="stylesheet" href="{{ mix('assets/css/web-app.css') }}" media="all">
            <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}" media="all">
            <link rel="stylesheet" href="{{ mix('assets/css/element.min.css') }}" media="all">
            <link rel="stylesheet" href="{{ mix('assets/css/custom.css') }}" media="all">
            <link rel="stylesheet" href="{{ mix('assets/css/sax.css') }}" media="all">

            <title>Dashboard :: {{ config('app.name', 'Sheep Default app') }}</title>

            <link rel="preconnect" crossorigin="use-credentials" href="https://fonts.googleapis.com">
            <link rel="preconnect" crossorigin="use-credentials" href="https://fonts.gstatic.com">
            <link rel="preconnect" crossorigin="use-credentials" href="https://www.google-analytics.com">
            <link rel="preconnect" crossorigin="use-credentials" href="https://www.googletagmanager.com">
            @stack('meta.tags')
        </head>

        <noscript>
            <!-- TODO: Hier een mooi vakje voor maken (GEEN JS) -->
            Voor deze app is javascript vereist!
        </noscript>

        <body>
        @yield('body')
        </body>

        @stack('script.tags')
        {{--<script type="text/javascript"--}}
        {{--        src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>--}}
        <script src="https://www.googletagmanager.com/gtag/js?id=G-DXGEP8BQL2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'G-DXGEP8BQL2');
        </script>
        </html>
