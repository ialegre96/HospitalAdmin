@extends('web.layouts.front')
@section('title')
    {{ __('messages.services') }}
@endsection
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.services') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.services') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-2.png') }}" data-aos="fade-left"
                     data-aos-delay="80"
                     data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Services Area -->
    <div class="services-area-without-color pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>{{ __('messages.web_home.our_services') }}</span>
                <h2>{{ __('messages.web_home.we_offer_different_services_to_improve_your_health') }}</h2>
            </div>

            <div class="row justify-content-center">

                @foreach($frontServices as $frontService)
                    <div class="col-lg-3 col-md-6 our-service-cards">
                        <div class="single-services-item h-100">
                            <div class="image">
                                <img src="{{ isset($frontService->icon_url) ? $frontService->icon_url : asset('web_front/images/services/medicine.png') }}"
                                     alt="image">
                            </div>

                            <div class="content">
                                <h3>
                                    <a href="#">{{ \Illuminate\Support\Str::limit($frontService->name, 16) }}</a>
                                </h3>
                                <p class="our-service-content">{!! \Illuminate\Support\Str::limit($frontService->short_description, 123)  !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="pagination-area">
                        {{ $frontServices->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="services-shape-wrap" data-speed="0.09" data-revert="true">
            <img src="{{ asset('web_front/images/services/shape-2.png') }}" alt="image">
        </div>
    </div>
    <!-- End Services Area -->
@endsection
