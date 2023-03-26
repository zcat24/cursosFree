<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss','resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>coursesFree</title>
</head>
<body>
    @include('layouts.navbar')

    @isset($slot)

    {{ $slot }}

    @endisset

    @yield('contenido')
    @livewireScripts
    @include('sweetalert::alert')
</body>
</html>