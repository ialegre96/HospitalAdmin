@extends('web.layouts.front')
@section('title')
    {{ __('Privacy Policy') }}
@endsection
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.privacy_policy') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ route('landing.home') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.privacy_policy') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-3.png') }}" data-aos="fade-left"
                     data-aos-delay="80"
                     data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Privacy Policy Area -->
    <div class="privacy-policy-area ptb-100">
        <div class="container">
            <div class="privacy-policy-content">
            {!! $frontSetting['privacy_policy'] !!}
        </div>
    </div>
</div>
<!-- End Privacy Policy Area -->
@endsection
