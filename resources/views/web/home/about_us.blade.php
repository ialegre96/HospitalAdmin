@extends('web.layouts.front')
@section('title')
    {{ __('messages.about_us') }}
@endsection
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.about_us') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.about_us') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-1.png') }}" data-aos="fade-left"
                     data-aos-delay="80" data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Why Choose Area -->
    <div class="why-choose-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="choose-fun-fact-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6">
                                <div class="choose-fun-fact">
                                    <h3>
                                        <span class="odometer" data-count="{{ $totalbeds }}">00</span>
                                    </h3>
                                    <p>{{ __('messages.web_home.patients_beds') }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="choose-fun-fact bg-ef720c">
                                    <h3>
                                        <span class="odometer" data-count="{{ $totalDoctorNurses }}">00</span>
                                    </h3>
                                    <p>{{ __('messages.web_home.doctors_nurses') }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="choose-fun-fact bg-ed2f16">
                                    <h3>
                                        <span class="odometer" data-count="{{ $totalPatient }}">00</span>
                                    </h3>
                                    <p>{{ __('messages.web_home.happy_patients') }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="choose-fun-fact bg-16ed8f">
                                    <h3>
                                        <span class="odometer"
                                              data-count="{{ getFrontSettingValue(\App\Models\FrontSetting::HOME_PAGE,'home_page_experience') }}">00</span>
                                    </h3>
                                    <p>{{ __('messages.web_home.years_experience') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-content">
                        <span>{{ __('messages.web_home.about_us') }}</span>
                        <h3>{{ \Illuminate\Support\Str::limit($frontSetting['about_us_title'], 50)  }}</h3>
                        <p class="about-us-content">{!! \Illuminate\Support\Str::limit($frontSetting['about_us_description'], 615)  !!}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="why-choose-shape-1" data-speed="0.08" data-revert="true">
            <img src="{{ asset('web_front/images/why-choose/shape-1.png') }}" alt="image">
        </div>

        <div class="why-choose-shape-2" data-speed="0.08" data-revert="true">
            <img src="{{ asset('web_front/images/why-choose/shape-2.png') }}" alt="image">
        </div>
    </div>
    <!-- End Why Choose Area -->

    <!-- Start Quality Healthcare Area -->
    <div class="quality-healthcare-area bg-f5f6fb pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="quality-healthcare-slides owl-carousel owl-theme">
                        @foreach($testimonials as $testimonial)
                            <div class="quality-single-card">
                                <div class="image">
                                    <img src="{{ $testimonial->document_url }}" alt="image">

                                    <div class="double-quotes-icon">
                                        <i class="ri-double-quotes-l"></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <p>{!! $testimonial->description !!}</p>

                                    <div class="info">
                                        <h3>{{ \Illuminate\Support\Str::limit($testimonial->name, 30) }}</h3>
                                    </div>
                                </div>

                                <div class="quality-shape-1" data-speed="0.09" data-revert="true">
                                    <img src="{{ asset('web_front/images/quality-healthcare/vector.png') }}"
                                         alt="image">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="quality-healthcare-content-with-image" data-speed="0.05" data-revert="true">
                        <span>{{ \Illuminate\Support\Str::limit(getFrontSettingValue(\App\Models\FrontSetting::HOME_PAGE, 'home_page_certified_doctor_text'), 60) }}</span>
                        <h3>{{ \Illuminate\Support\Str::limit(getFrontSettingValue(\App\Models\FrontSetting::HOME_PAGE, 'home_page_certified_doctor_title'), 50) }}</h3>
                        <p class="quality-content-paragraph"> {!!  \Illuminate\Support\Str::limit(getFrontSettingValue(\App\Models\FrontSetting::HOME_PAGE, 'home_page_certified_doctor_description'), 130)  !!}</p>


                        <div class="quality-vector-image" data-speed="0.05" data-revert="true">
                            <img src="{{ asset('web_front/images/quality-healthcare/vector-image.png') }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="quality-healthcare-image-shape" data-speed="0.09" data-revert="true">
            <img src="{{ asset('web_front/images/quality-healthcare/quality-4.png') }}" alt="image">
        </div>
    </div>
    <!-- End Quality Healthcare Area -->

    <!-- Start Doctors Area -->
    <div class="doctors-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>{{ __('messages.web_home.professional_doctors') }}</span>
                <h2>{{ __('messages.web_home.we_are_experienced_healthcare_professionals') }}</h2>
            </div>

            <div class="row justify-content-center">
                @foreach($doctors as $index => $doctor)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-doctors-card">
                            <div class="doctors-image">
                                <a href="#"><img src="{{ $doctor->user->image_url }}" alt="image"></a>
                            </div>

                            <div class="doctors-content">
                                <h3>
                                    <a href="javascript:void(0);">{{ \Illuminate\Support\Str::limit($doctor->user->full_name, 23) }}</a>
                                </h3>

                                <ul class="doc-info">
                                    <li>({{ \Illuminate\Support\Str::limit($doctor->user->qualification, 25) }})</li>
                                </ul>

                                <span>{{ \Illuminate\Support\Str::limit($doctor->specialist, 15) }} {{ __('messages.doctor.specialist') }}</span>

                                <div class="doc-location">
                                    <p>{{ $doctor->patients_count }}{{ $doctor->patients_count > 0 ? '+' : ''}}
                                        {{ __('messages.web_home.patients') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Doctors Area -->
@endsection
