<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <title>{{ config('app.name', 'Boolbnb') }}</title>

    @vite(['resources/js/app.js'])

    {{-- Fontawesome --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'
        integrity='sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=='
        crossorigin='anonymous' />
    {{-- cdn --}}
    @yield('cdn')
</head>

<body>
    <div id="app">
        {{-- header --}}
        @include('includes.header')

        {{-- main --}}
        @yield('main')

        {{-- footer --}}
        @include('includes.footer')
    </div>
</body>

</html>
