@extends('web.layouts.front')
@section('title')
    {{ __('Working Hours') }}
@endsection
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.working_hours') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ route('landing.home') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.working_hours') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-5.png') }}" data-aos="fade-left"
                     data-aos-delay="80" data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Book Appointment Area -->
    <div class="book-appointment-area pt-100">
        <div class="container">
            <div class="book-appointment-inner-box ptb-100">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-12">
                        <div class="book-appointment-title">
                            <h3>{{ __('messages.web_home.book_an_appointment') }}</h3>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <form class="book-appointment-form">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <select class="doctor-name-filter">
                                            <option value="1">{{ __('messages.web_home.select_doctor') }}</option>
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
                                               id="datepicker">
                                        <label><i class="ri-calendar-todo-line"></i></label>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="book-appointment-btn">
                                        <a href="{{ route('appointment', getUser()->username) }}">
                                            <button type="button"
                                                    class="default-btn">{{ __('messages.web_home.book_now') }}</button>
                                        </a>
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

    <!-- Start Working Hours Area -->

    <div class="working-hours-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12">
                    <div class="working-hours-wrap">
                        <h3>{{ __('messages.web_working_hours.opening_hours') }}</h3>
                        @if(count($hospitalSchedules))
                            <ul class="time-info">
                                @foreach($hospitalSchedules as $hospitalSchedule)
                                    <li>{{$weekDay[$hospitalSchedule->day_of_week]}}
                                        <span> {{ $hospitalSchedule->start_time.' - '.$hospitalSchedule->end_time  }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <h5 class="text-center">{{ __('messages.web_working_hours.no_yet_opening_hours') }}</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Working Hours Area -->
@endsection
