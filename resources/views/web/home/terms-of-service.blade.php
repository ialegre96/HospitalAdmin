@extends('web.layouts.front')
@section('title')
    {{ __('Terms of Service') }}
@endsection
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.terms_of_service') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.terms_of_service') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-1.png') }}" data-aos="fade-left"
                     data-aos-delay="80"
                     data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Terms of Service Area -->
    <div class="terms-of-service-area ptb-100">
        <div class="container">
            <div class="terms-of-service-content">
               {!! $frontSetting['terms_conditions'] !!}
            </div>
        </div>
    </div>
    <!-- End Terms of Service Area -->
@endsection
