<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>POSMaster</title>
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
    <script src="{{ asset('js/shortcut.js') }}" defer></script>

    <script language="javascript" type="text/javascript">
        function windowClose() {
            window.open('','_parent','');
            window.close();
        }
    </script>

    <script type="text/javascript">
        function init() {
            shortcut.add("Insert", function() {
                document.getElementById("SaveSale").click();
            });
            shortcut.add("Delete", function() {
                document.getElementById("CloseSale").click();
            });
            shortcut.add("f9", function() {
                document.getElementById("PrintSale").click();
            });
            shortcut.add("f10", function() {
                document.getElementById("Print").click();
            });
            shortcut.add("Ctrl+Alt+1", function() {
                markCalled("ctrlalt1");
            });
            shortcut.add("Ctrl+Shift+1", function() {
                markCalled("ctrlshift1");
            });
            shortcut.add("Shift+Alt+1", function() {
                markCalled("shiftalt1");
            });
            shortcut.add("Ctrl+2", function() {
                markCalled("ctrl2");
            });
            shortcut.add("3", function() {
                markCalled("just3");
            },{"disable_in_input":true});
            shortcut.add("Ctrl+a", function() {
                markCalled("ctrla");
            },{"propagate":true});
            shortcut.add("",function() {
                markCalled("just4");
            },{"keycode":52});
        }
        window.onload=init;
    </script>
</head>
<body>
<!-- Add Navigation Bar -->


<main class="container">
    @auth
        @if (Request::is('newsales/*') OR Request::is('newsales'))

        @else
            <x-navbar/>
            @endif

    @endauth
    <div class="mt-2">
    <x-messages/>
    </div>
{{ $slot }}

</main>
<x-footer/>
<livewire:scripts />

</body>

</html>
