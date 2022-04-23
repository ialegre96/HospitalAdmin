@extends('web.layouts.front')
@section('title')
    {{ __('Testimonials') }}
@endsection
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.testimonials') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ route('landing.home') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.testimonials') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-3.png') }}" data-aos="fade-left"
                     data-aos-delay="80" data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Testimonials Area -->
    <div class="testimonials-area bg-image-transparent ptb-100">
        <div class="container">
            <div class="section-title">
                <span>{{ __('messages.web_home.our_testimonials') }}</span>
                <h2>{{ __('messages.web_home.what_our_patient_say_about_medical_treatments') }}</h2>
            </div>

            <div class="row justify-content-center">
                @foreach($testimonials as $testimonial)
                    <div class="col-lg-6 col-md-12">
                        <div class="testimonials-card-item">
                            <div class="image">
                                <img src="{{ $testimonial->document_url }}" alt="image">

                                <div class="double-quotes-icon">
                                    <i class="ri-double-quotes-l"></i>
                                </div>
                            </div>
                            <div class="content">
                                <p>{{ $testimonial->description }}</p>

                                <div class="info">
                                    <h3>{{ \Illuminate\Support\Str::limit($testimonial->name, 46) }}</h3>
                                </div>
                            </div>

                            <div class="testimonials-shape-1" data-speed="0.09" data-revert="true">
                                <img src="{{ asset('web_front/images/testimonials/vector.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="pagination-area">
                        {{ $testimonials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonials Area -->
@endsection
