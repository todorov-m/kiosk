<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Laravel</title>
    <livewire:styles />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>function isLoaded()
        {
            var pdfFrame = window.frames["pdf"];
            pdfFrame.focus();
            pdfFrame.print();
        }</script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
    <script src="{{ asset('js/cdn.min.js') }}" defer></script>

</head>
<body>
<!-- Add Navigation Bar -->
@auth

<x-navbar/>
@endauth


<main class="container">
    <div class="mt-2">
    <x-messages/>
    </div>
{{ $slot }}

</main>

<livewire:scripts />

</body>

</html>
