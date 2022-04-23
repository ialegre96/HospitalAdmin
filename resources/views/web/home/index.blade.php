@extends('web.layouts.front')
@section('title')
    {{ __('web.home') }}
@endsection
@section('content')
    @php
        $user = getUser();
    @endphp
    <div class="main-banner-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="main-banner-content-with-search" data-speed="0.06" data-revert="true">
                        <span data-aos="fade-down" data-aos-delay="50"
                              data-aos-duration="500">{{ $frontSetting['home_page_experience'] }} {{ __('messages.web_home.years_experience') }}</span>
                        <h1 data-aos="fade-right" data-aos-delay="70"
                            data-aos-duration="700">{{ \Illuminate\Support\Str::limit($frontSetting['home_page_title'], 42) }}</h1>
                        <p data-aos="fade-up" data-aos-delay="80"
                           data-aos-duration="800">{{ \Illuminate\Support\Str::limit($frontSetting['home_page_description'], 170) }}</p>
                    </div>
                    @if(!Auth::user())
                        <a href="{{ route('register') }}"
                           class="default-btn signup_btn">{{ __('messages.web_home.sign_up') }}</a>
                    @endif
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="main-banner-image-with-doctor" data-speed="0.06" data-revert="true">
                        <img
                                src="{{ ($frontSetting['home_page_image']) ? $frontSetting['home_page_image'] : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}"
                                data-aos="fade-up" data-aos-delay="80" data-aos-duration="800" alt="doctor"
                                class="main-doctor-image">

                        <div class="circle-pattern" data-aos="fade-down" data-aos-delay="900"
                             data-aos-duration="900"></div>

                        <div class="banner-card-content" data-aos="fade-up" data-aos-delay="700"
                             data-aos-duration="700">
                            <div class="icon">
                                <i class="ri-chat-new-line"></i>
                            </div>
                            <h3>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_box_title'], 15) }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_box_description'], 40) }}</p>
                        </div>

                        <div class="banner-doctor-content" data-aos="fade-up-right" data-aos-delay="50"
                             data-aos-duration="500">
                            <div class="title-info">
                                <h3>{{ __('messages.web_home.available_doctors') }}</h3>
                                <p>{{ __('messages.web_home.select_doctors') }}</p>
                            </div>

                            <div class="doctor-info-box">
                                @foreach($doctorAppointments as $index => $doctor)
                                    @if($index == 4)
                                        @break;
                                    @endif
                                    <div class="info-item">
                                        <img src="{{ $doctor->user->image_url }}" alt="image">
                                        <h4>{{ \Illuminate\Support\Str::limit($doctor->user->full_name, 23) }}</h4>
                                        <span>{{ \Illuminate\Support\Str::limit($doctor->user->qualification, 20) }}</span>
                                    </div>
                                @endforeach
                                <div class="doctor-contact-btn">
                                    <a href="{{ route('our-doctors', $user->username) }}"
                                       class="default-btn">{{ __('messages.web_home.contact_doctors') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="banner-image-shape-1" data-aos="fade-up" data-aos-delay="50"
                             data-aos-duration="500">
                            <img src="{{ asset('web_front/images/main-banner/banner-one/banner-shape-1.png') }}"
                                 alt="image">
                        </div>

                        <div class="banner-image-shape-2" data-aos="fade-up" data-aos-delay="70"
                             data-aos-duration="700">
                            <img src="{{ asset('web_front/images/main-banner/banner-one/banner-shape-2.png') }}"
                                 alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Banner Area -->

    <!-- Start Easy Solutions Area -->
    <div class="easy-solutions-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>{{ __('messages.web_home.easy_solutions') }}</span>
                <h2>{{ __('messages.web_home.4_easy_step_and_get_the_world_best_treatment') }}</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-solutions-card">
                        <div class="icon">
                            <i class="ri-user-search-line"></i>
                        </div>
                        <h3>
                            <a href="javascript:void(0)">{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_1_title'], 22) }}</a>
                        </h3>
                        <p>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_1_description'], 114) }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-solutions-card">
                        <div class="icon">
                            <i class="ri-git-pull-request-line"></i>
                        </div>
                        <h3>
                            <a href="javascript:void(0)">{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_2_title'], 22) }}</a>
                        </h3>
                        <p>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_2_description'], 114) }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-solutions-card">
                        <div class="icon">
                            <i class="ri-calendar-check-line"></i>
                        </div>
                        <h3>
                            <a href="javascript:void(0)">{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_3_title'], 22) }}</a>
                        </h3>
                        <p>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_3_description'], 114) }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-solutions-card">
                        <div class="icon">
                            <i class="ri-check-double-line"></i>
                        </div>
                        <h3>
                            <a href="javascript:void(0)">{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_4_title'], 22) }}</a>
                        </h3>
                        <p>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_step_4_description'], 114) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Easy Solutions Area -->

    <!-- Start Book Appointment Area -->
    <div class="book-appointment-area">
        <div class="container">
            <div class="book-appointment-inner-box ptb-100">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-12">
                        <div class="book-appointment-title">
                            <h3>{{ __('messages.web_home.book_an_appointment') }}</h3>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <form action="{{route('appointment', $user->username)}}" class="book-appointment-form"
                              method="POST">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <select class="doctor-name-filter" name="doctorId">
                                            <option value="">{{ __('messages.web_home.select_doctor') }}</option>
                                            @foreach($doctors as $doctor)
                                                <option
                                                        value="{{ $doctor->id }}">{{ $doctor->user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text"
                                               placeholder="{{ __('messages.web_appointment.select_time') }}"
                                               id="datepicker" name="appointmentDate">
                                        <label><i class="ri-calendar-todo-line"></i></label>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="book-appointment-btn">
                                        <button type="submit"
                                                class="default-btn">{{ __('messages.web_home.book_now') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Book Appointment Area -->

    <!-- Start Why Choose Area -->
    <div class="why-choose-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="choose-fun-fact-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="choose-fun-fact test">
                                    <h3>
                                        <span class="odometer" data-count="{{ $totalbeds }}">00</span>
                                    </h3>
                                    <p>{{ __('messages.web_home.patients_beds') }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="choose-fun-fact bg-ef720c">
                                    <h3>
                                        <span class="odometer" data-count="{{ $totalDoctorNurses }}">00</span>
                                    </h3>
                                    <p>{{ __('messages.web_home.doctors_nurses') }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="choose-fun-fact bg-ed2f16">
                                    <h3>
                                        <span class="odometer" data-count="{{ $totalPatient }}">00</span>
                                    </h3>
                                    <p>{{ __('messages.web_home.happy_patients') }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="choose-fun-fact bg-16ed8f">
                                    <h3>
                                        <span class="odometer" data-count="{{ $frontSetting['home_page_experience'] }}">00</span>
                                    </h3>
                                    <p>{{ __('messages.web_home.years_experience') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-content">
                        <h3>{{ \Illuminate\Support\Str::limit(getFrontSettingValue(\App\Models\FrontSetting::ABOUT_US, 'about_us_title'), 31) }}</h3>
                        <p> {!!  \Illuminate\Support\Str::limit(getFrontSettingValue(\App\Models\FrontSetting::ABOUT_US, 'about_us_description'), 615)  !!}</p>
                        <div class="why-choose-btn">
                            <a href="{{ route('appointment', $user->username) }}"
                               class="default-btn">{{ __('messages.web_home.book_appointment') }}</a>
                        </div>
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

    <!-- Start Services Area -->
    <div class="services-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>{{ __('messages.web_home.our_services') }}</span>
                <h2>{{ __('messages.web_home.we_offer_different_services_to_improve_your_health') }}</h2>
            </div>

            <div class="row justify-content-center">
                @foreach($frontServices  as $frontService)
                    <div class="col-lg-3 col-md-6 col-sm-6 our-service-cards">
                        <div class="single-services-card h-100">
                            <div class="image">
                                <img src="{{ isset($frontService->icon_url) ? $frontService->icon_url : asset('web_front/images/services/medicine.png') }}"
                                     alt="image">
                            </div>

                            <div class="content">
                                <h3>
                                    <a>{{ \Illuminate\Support\Str::limit($frontService->name, 16) }}</a>
                                </h3>
                                <p>{!!  \Illuminate\Support\Str::limit($frontService->short_description, 123)  !!}</p>
                            </div>

                            <div class="services-shape-1">
                                <img src="{{ asset('web_front/images/services/shape-1.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Services Area -->

    <!-- Start Healthcare Doctor Area -->
    <div class="healthcare-doctor-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="healthcare-doctor-content" data-speed="0.05" data-revert="true">
                        <span> {{ \Illuminate\Support\Str::limit($frontSetting['home_page_certified_doctor_text'], 64) }}</span>
                        <h3>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_certified_doctor_title'], 64) }}</h3>
                        <p>{!! \Illuminate\Support\Str::limit($frontSetting['home_page_certified_doctor_description'], 326) !!}</p>

                        <div class="healthcare-btn">
                            <a href="{{ route('appointment', $user->username) }}"
                               class="default-btn">{{ __('messages.web_home.book_appointment') }}</a>
                        </div>

                        <div class="healthcare-stethoscope">
                            <img src="{{ asset('web_front/images/healthcare-doctor/stethoscope.png') }}" alt="image">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="healthcare-doctor-image" data-speed="0.05" data-revert="true">
                        <img src="{{ $frontSetting['home_page_certified_doctor_image'] }}" alt="image">

                        <div class="circle-pattern d-lg-block d-none"></div>

                        <div class="healthcare-card-content">
                            <div class="icon">
                                <i class="ri-medal-2-line"></i>
                            </div>
                            <h3>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_certified_box_title'], 16) }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($frontSetting['home_page_certified_box_description'], 44) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Healthcare Doctor Area -->

    <!-- Start Professional Doctors Area -->
    <div class="professional-doctors-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span>{{ __('messages.web_home.professional_doctors') }}</span>
                <h2>{{ __('messages.web_home.we_are_experienced_healthcare_professionals') }}</h2>
            </div>

            <div class="professional-doctors-slides owl-carousel owl-theme">
                @foreach($doctorAppointments as $doctor)
                    <div class="professional-doctors-card">
                        <div class="doctors-image">
                            <a href="#"><img src="{{ $doctor->user->image_url }}" alt="image"></a>

                            <ul class="social">
                                @if(!is_null($doctor->user->facebook_url))
                                    <li>
                                        <a href="{{ $doctor->user->facebook_url }}" target="_blank">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(!is_null($doctor->user->twitter_url))
                                    <li>
                                        <a href="{{ $doctor->user->twitter_url }}" target="_blank">
                                            <i class="ri-twitter-fill"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(!is_null($doctor->user->instagram_url))
                                    <li>
                                        <a href="{{ $doctor->user->instagram_url }}" target="_blank">
                                            <i class="ri-instagram-line"></i>
                                        </a>
                                    </li>
                                @endif
                                    @if(!is_null($doctor->user->linkedIn_url))
                                        <li>
                                            <a href="{{ $doctor->user->linkedIn_url }}" target="_blank">
                                                <i class="ri-linkedin-line"></i>
                                            </a>
                                        </li>
                                    @endif
                            </ul>
                        </div>
                        <div class="doctors-content">
                            <span>{{ \Illuminate\Support\Str::limit($doctor->user->qualification, 45) }}</span>
                            <h3>
                                <a href="#">{{ \Illuminate\Support\Str::limit($doctor->user->full_name, 23) }}</a>
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="professional-doctors-shape-1">
            <img src="{{ asset('web_front/images/doctors/shape-1.png') }}" alt="image">
        </div>
    </div>
    <!-- End Professional Doctors Area -->

    <!-- Start Testimonials Area -->
    <div class="testimonials-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span>{{ __('messages.web_home.our_testimonials') }}</span>
                <h2>{{ __('messages.web_home.what_our_patient_say_about_medical_treatments') }}</h2>
            </div>

            <div class="testimonials-slides owl-carousel owl-theme">
                @foreach($testimonials as $testimonial)
                    <div class="testimonials-card-item">
                        <div class="image">
                            <img src="{{ $testimonial->document_url }}" height="100" width="100" alt="image">

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
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Testimonials Area -->
@endsection
