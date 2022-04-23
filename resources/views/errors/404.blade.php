<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="{{config('app.name')}}">

    <meta name="keywords" content="{{getCompanyName()}}"/>

    <meta name="description" content="{{getAppName()}}"/>
    <meta name="author" content="{{getCompanyName()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>404 Not Found | {{ config('app.name') }}</title>

    <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/fonts.css') }}" rel="stylesheet" type="text/css"/>
    @yield('page_css')
    <link href="{{ asset('backend/css/3rd-party.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party-custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body class="d-flex ">
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-center flex-column-fluid p-10">
        <img src="{{ asset('web/img/404.png') }}" class="mw-100 mb-10 h-lg-450px">
        <h1 class="fw-bold mb-10">Opps! Something's missing...</h1>
        <a class="btn btn-primary fw-bolder mt-3" href="{{ route('landing.home') }}">Back to Home Page</a>
    </div>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
</body>
</html>
