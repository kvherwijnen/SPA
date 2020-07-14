@extends('layouts.AI')

@push('meta.tags')

    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="application-name" content="{{ config('app.name', 'Sheep default app') }}">
    <meta name="name" content="{{ config('app.name', 'Sheep default app') }}">
    <meta name="theme-color" content="#0a0b15">
    <link rel="preload" as="script" href="{{ mix('assets/scripts//app.js') }}">
    <link rel="favicon" href="{{ url('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/img/icons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('assets/img/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('assets/img/icons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ url('assets/img/icons/icon-high-res-512.png') }}">

    <link rel="apple-touch-icon" href="{{ url('assets/img/icons/apple-icon.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('assets/img/icons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('assets/img/icons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('assets/img/icons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/img/icons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('assets/img/icons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('assets/img/icons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('assets/img/icons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('assets/img/icons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ url('assets/img/icons/apple-icon-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/img/icons/apple-icon-180x180.png') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url('assets/img/icons/apple-icon.png') }}">

    <meta name="appleid-signin-client-id" content="[CLIENT_ID]">
    <meta name="appleid-signin-scope" content="[SCOPES]">
    <meta name="appleid-signin-redirect-uri" content="[REDIRECT_URI]">
    <meta name="appleid-signin-state" content="[STATE]">

    <!-- iPhone XS MAX (1242px x 2688px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
          href="assets/img/splash/iphonexsmax_splash.png">
    <!-- iPhone XS MAX (1242px x 2688px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
          href="assets/img/splash/iphone_11max.png">
    <!-- iPhone X (1125px x 2436px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
          href="assets/img/splash/iphonex_splash.png">
    <!-- iPhone X (1125px x 2436px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
          href="assets/img/splash/iphonexs_land.png">
    <!-- iPhone 8, 7, 6s, 6 (750px x 1334px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
          href="{{ url('assets/img/splash/iphone6_splash.png') }}">
    <!-- iPhone 8 Plus, 7 Plus, 6s Plus, 6 Plus (1242px x 2208px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
          href="{{ url('assets/img/splash/iphoneplus_splash.png') }}">
    <!-- iPhone 5 (640px x 1136px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
          href="{{ url('assets/img/splash/iphone5_splash.png') }}">

    <!-- iPad 1-4 & Air (768px x 1024px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
          href="{{ url('assets/img/splash/ipad_splash.png') }}">
    <!-- iPad 1-4 & Air (768px x 1024px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
          href="{{ url('assets/img/splash/Ipad_land.png') }}">

    <!-- iPad Pro 1 (834px x 1112px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
          href="{{ url('assets/img/splash/ipadpro1_splash.png') }}">
    <!-- iPad Pro 1 (834px x 1112px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
          href="{{ url('assets/img/splash/Ipadpro10_land.png') }}">

    <!-- iPad Pro 2 (1024px x 1366px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
          href="{{ url('assets/img/splash/ipadpro2_splash.png') }}">
    <!-- iPad Pro 2 (1024px x 1366px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
          href="{{ url('assets/img/splash/ipadpro12_land.png') }}">

    <!-- iPad Pro 3 (834px x 1194px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
          href="{{ url('assets/img/splash/ipadpro3_splash.png') }}">
    <!-- iPad Pro 3 (834px x 1194px) -->
    <link rel="apple-touch-startup-image"
          media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
          href="{{ url('assets/img/splash/Ipadpro11_land.png') }}">

    <meta name="msapplication-TileImage" size="70x70" content="{{ url('assets/img/icons/ms-icon-70x70.png') }}">
    <meta name="msapplication-TileImage" size="144x144" content="{{ url('assets/img/icons/ms-icon-144x144.png') }}">
    <meta name="msapplication-TileImage" size="150x150" content="{{ url('assets/img/icons/ms-icon-150x150.png') }}">
    <meta name="msapplication-TileImage" size="310x310" content="{{ url('assets/img/icons/ms-icon-310x310.png') }}">
    <meta name="msapplication-TileColor" content="#0E103C">
    <base href="{{ env('APP_URL') }}">

    <!-- Structured Data -->
    <script type="application/ld+json">
            {
                "@context": "https://schema.org/",
                "@type": "Web",
                "name": "Artificial Intelligence",
                "url": "https://www.sheep-ai.com/",
                "image": "https://sheep-ai.com/assets/img/icons/icon-high-res-512.png",
                "jobTitle": "Artificial Intelligence"
            }

    </script>
    {{--    <script type="text/javascript"--}}
    {{--            src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>--}}

    {{--    <script type="text/javascript">--}}
    {{--        AppleID.auth.init({--}}
    {{--            clientId: '[CLIENT_ID]',--}}
    {{--            scope: '[SCOPES]',--}}
    {{--            redirectURI: '[REDIRECT_URI]',--}}
    {{--            state: '[STATE]',--}}
    {{--            usePopup: true //or false defaults to false--}}
    {{--        });--}}
    {{--    </script>--}}
@endpush

@section('body')
    <div class="body-wrapper">
        <div id="app">
            <div id="vue-loading">
                {{ __('') }}
            </div>
            <App></App>
        </div>
    </div>
@endsection

@push('script.tags')
    <script src="{{ mix('assets/scripts//app.js') }}" type="text/javascript" defer></script>

    @if(env('APP_ENV') === 'production')
        <script src="{{ url('__offline_serviceworker.gz') }}"></script>
    @endif
@endpush
