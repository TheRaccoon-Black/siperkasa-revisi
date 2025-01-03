<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('img/airport.png') }}">
    <title>@yield('title', 'SIPERKASA')</title>

    @stack('styles')
</head>

<body>
    <div class="font-text text-sm" id="app">
        @yield('app')
    </div>

    @stack('scripts')
</body>

</html>
