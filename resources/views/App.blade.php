<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Snap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Snap is an application for handling PDF files, Snippets and Links">
    <meta name="title" content="Snap App">
    <meta name="author" content="Jose Francisco Paredes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--    <link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}">--}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- STYLES -->
    <link href="{{ asset('/css/utilities/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <router-view></router-view>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/utilities/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/js/utilities/popper.min.js') }}"></script>
    <script src="{{ asset('/js/utilities/bootstrap.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/67ee180fdd.js"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
