<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="//fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('backend/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('backend/css/fonts.css') }}" rel="stylesheet" type="text/css"/>
        @yield('page_css')
        <link href="{{ asset('backend/css/3rd-party.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('backend/css/3rd-party-custom.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <div class="flex-center position-ref full-height">
        <div>
            @yield('content')
        </div>
    </div>
    </body>
</html>
