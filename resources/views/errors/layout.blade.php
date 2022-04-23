<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="//fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    </head>
    <body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title">
                @yield('message')
            </div>
        </div>
    </div>
    </body>
</html>
