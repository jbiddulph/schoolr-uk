<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Properties, Events and news along the south coast within East and West Sussex."/>
    <meta name="keywords" content="Brighton News, Hove News, Portslade Latest, Shoreham News, News Lancing, Worthing News">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Local Property, News and Events in the South - BN Here</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e167166ec4.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://vanderlee.github.io/colorpicker/jquery.colorpicker.css">
</head>
<body>
    <div id="app">
        @include('layouts.includes.header')
        <main>
            @yield('content')
        </main>
    </div>
    @include('layouts.includes.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://vanderlee.github.io/colorpicker/jquery.colorpicker.js"></script>
    @stack('custom-scripts')
</body>
</html>
