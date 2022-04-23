<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="{{config('app.name')}}">

    <meta name="keywords" content="Hospital Management System"/>

    <meta name="description" content="Hospital Management System | HMS"/>
    <meta name="author" content="hms.infyom.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @php
        $hospitalSettingValue = getSettingValue();
    @endphp
    <link rel="icon" href="{{ $hospitalSettingValue['favicon']['value'] }}" type="image/png">

    <!-- Links of CSS files -->
    <link rel="stylesheet" href="{{ asset('web_front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/selectize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('web_front/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/landing-theme/css/toastr.css') }}"/>
    @yield('page_css')
    @yield('css')
</head>
<body>
@include('web.layouts.web_loader')
@include('web.layouts.header')
@yield('content')
@include('web.layouts.footer')

<!-- Start Go Top Area -->
<div class="go-top">
    <i class="ri-arrow-up-s-line"></i>
</div>
<!-- End Go Top Area -->

<!-- Links of JS files -->
<script src="{{ asset('web_front/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
<script src="{{ asset('assets/landing-theme/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('web_front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('web_front/js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('web_front/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('web_front/js/jquery.appear.js') }}"></script>
<script src="{{ asset('web_front/js/odometer.min.js') }}"></script>
<script src="{{ asset('web_front/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('web_front/js/fancybox.min.js') }}"></script>
<script src="{{ asset('web_front/js/jquery-ui.js') }}"></script>
<script src="{{ asset('web_front/js/selectize.min.js') }}"></script>
<script src="{{ asset('web_front/js/TweenMax.min.js') }}"></script>
<script src="{{ asset('web_front/js/aos.js') }}"></script>
<script src="{{ asset('web_front/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('web_front/js/form-validator.min.js') }}"></script>
<script src="{{ asset('web_front/js/contact-form-script.js') }}"></script>
<script src="{{ asset('web_front/js/wow.min.js') }}"></script>
<script src="{{ asset('web_front/js/main.js') }}"></script>
<script src="{{ asset('assets/js/fontawesome.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
    });
    $(document).on('click', '.languageSelection', function () {
        let languageName = $(this).data('prefix-value');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'POST',
            url: '/change-language',
            data: {languageName: languageName},
            success: function () {
                location.reload();
            },
        });
    });
</script>
@yield('page_scripts')
@yield('scripts')
</body>
</html>
