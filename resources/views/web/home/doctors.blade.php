@extends('web.layouts.front')
@section('title')
    {{ __('messages.doctors') }}
@endsection
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.doctors') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.doctors') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-5.png') }}" data-aos="fade-left"
                     data-aos-delay="80" data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Doctors Area -->
    <div class="doctors-area bg-f5f6fb pt-100 pb-100">
        <div class="container">
            <div class="section-title">
                <span>{{ __('messages.web_home.professional_doctors') }}</span>
                <h2>{{ __('messages.web_home.we_are_experienced_healthcare_professionals') }}</h2>
            </div>

            <div class="row justify-content-center">
                @foreach($doctors as $doctor)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-doctors-card">
                            <div class="doctors-image">
                                <a href="#"><img src="{{ $doctor->user->image_url }}"
                                                 alt="image"></a>
                            </div>

                            <div class="doctors-content">
                                <h3>
                                    <a href="javascript:void(0)">{{ \Illuminate\Support\Str::limit($doctor->user->full_name, 23) }}</a>
                                </h3>

                                <ul class="doc-info">
                                    <li>({{ \Illuminate\Support\Str::limit($doctor->user->qualification, 25) }})</li>
                                </ul>

                                <span>{{ \Illuminate\Support\Str::limit($doctor->specialist, 15) }} {{ __('messages.doctor.specialist') }}</span>

                                <div class="doc-location">
                                    <p>{{ $doctor->patients_count }}{{ $doctor->patients_count > 0 ? '+' : ''}}
                                        Patients</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="pagination-area">
                        {{ $doctors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Doctors Area -->
@endsection
