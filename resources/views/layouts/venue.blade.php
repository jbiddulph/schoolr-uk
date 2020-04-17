<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163275218-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-163275218-1');
    </script>
    <meta charset="utf-8">
    <meta name="description" content="{{$thevenue->town}} pubs and venues, Properties, Events and news along the south coast within East and West Sussex."/>
    <meta name="keywords" content="{{$thevenue->town}} pubs, {{$thevenue->town}}, {{$thevenue->town}} News, {{$thevenue->town}} property">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$thevenue->venuename}}, {{$thevenue->town}}, {{$thevenue->county}} - Local pubs and venues around Sussex</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e167166ec4.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://vanderlee.github.io/colorpicker/jquery.colorpicker.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-28646788-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-28646788-2');
    </script>
    @yield('head')
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
