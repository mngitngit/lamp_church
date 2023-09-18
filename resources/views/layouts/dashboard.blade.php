<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:image" content="https://online.lampawta.com/images/registration_banner.jpeg" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://online.lampawta.com/registration"/>
    <meta property="og:title" content="Annual Worship and Thanksgiving 2023" />
    <meta property="og:description" content="Year of Clustering"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/dashboard.js?time=') }}{{ time() }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main style="min-height: 100vh; background-color: #ebebeb" class="py-3">
            @yield('content')
        </main>

        @yield('footer')
    </div>
</body>
<!-- import JavaScript -->
{{-- <script src="https://unpkg.com/element-ui/lib/index.js"></script> --}}
</html>