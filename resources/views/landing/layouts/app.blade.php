<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ getAppName()}} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="google" content="notranslate">
    @php 
        $settingValue = getSuperAdminSettingValue();
    @endphp
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="{{ $settingValue['favicon']['value'] }}" type="image/png">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <link href="{{asset('assets/landing-theme/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/animate.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/line-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/magnific-popup/magnific-popup.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/owl-carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/spacing.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/base.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/shortcodes.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/landing-theme/css/theme-color/color-5.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/>
    @yield('page_css')
    @yield('css')
</head>
<body>

{{--<div class="page-wrapper">--}}
{{--    <div id="ht-preloader">--}}
{{--        <div class="clear-loader">--}}
{{--            <div class="loader">--}}
{{--                <div class="loader-div"><span>{{ getAppName()}}</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@include('landing.layouts.header')

@yield('content')

<div id="waterdrop"></div>
@include('landing.layouts.footer')
</div>

@routes
<script src="{{asset('assets/landing-theme/js/common-theme.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/jquery.nice-select.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/counter/counter.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/particles.min.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/vivus/pathformer.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/vivus/vivus.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/raindrops/jquery-ui.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/raindrops/raindrops.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/countdown/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/contact-form/contact-form.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/wow.min.js')}}"></script>
<script src="{{asset('assets/landing-theme/js/theme-script.js')}}"></script>
<script src="{{ asset('assets/js/landing/languageChange/languageChange.js') }}"></script>
<script src="{{ mix('assets/js/subscribe/create.js') }}"></script>
<script>
    setTimeout(function () {
        $('.custom-message').fadeOut();
    }, 2000)
</script>
@yield('page_scripts')
@yield('scripts')
</body>
</html>
