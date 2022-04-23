<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title') | {{getAppName()}}</title>
    <meta name="description" content="Hospital management system">
    <meta name="keyword" content="hospital,doctor,patient,fever,MD,MS,MBBS">
    <link rel="icon" href="{{ asset('web/img/hms-saas-favicon.ico') }}" type="image/png">
    <link rel="canonical" href="{{ route('landing.home') }}"/>
    <link rel="stylesheet" href="{{ asset('favicon.ico') }}" type="image/png">
    <link rel="icon" href="{{ asset('web/img/hms-saas-favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    @yield('css')
</head>
<?php
$style = 'style=';
?>
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed"
{{$style}}"--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<div class="d-flex flex-column flex-root">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('backend/js/vendor.js') }}"></script>
<script src="{{ asset('backend/js/3rd-party-custom.js') }}"></script>
@yield('scripts')
<script>
    $(document).ready(function () {
        setTimeout(function () { $('.alert').fadeOut('slow'); }, 3000);
        $(document).on('submit', '.form-submit', function () {
            let buttonIndicator = document.querySelector('.indicator');
            buttonIndicator.setAttribute('data-kt-indicator', 'on');
        });
    });
</script>
</body>
</html>
