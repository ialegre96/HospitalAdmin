<!-- Start Navbar Area -->
@php
    $user = getUser();
    $hospitalSettingValue = getSettingValue();
@endphp
<div class="navbar-area {{ Request::is('/') ? 'fixed-top' : 'navbar-style-three' }}">
    <div class="main-responsive-nav">
        <div class="container">
            <div class="main-responsive-menu">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ $hospitalSettingValue['favicon']['value'] }}" class="favicon-logo" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navbar">
        <div class="{{ Request::is('/') ? 'container-fluid' : 'container' }}">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ getLogoUrl() }}" class="front-header-logo" alt="logo">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item {{ Route::currentRouteName() == 'front' ? 'active' : '' }}">
                            <a href="{{ route('front', $user->username) }}"
                               class="nav-link {{ Request::is('/') ? 'active' : '' }}">{{ __('messages.web_home.home') }}</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() == 'our-services' ? 'active' : '' }}">
                            <a href="{{ route('our-services', $user->username) }}"
                               class="nav-link {{ Request::is('our-services') ? 'active' : '' }}">{{ __('messages.web_home.services') }}</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() == 'our-doctors' ? 'active' : '' }}">
                            <a href="{{ route('our-doctors', $user->username) }}"
                               class="nav-link {{ Request::is('our-doctors') ? 'active' : '' }}">{{ __('messages.web_home.doctors') }}</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() == 'aboutUs' ? 'active' : '' }}">
                            <a href="{{ route('aboutUs', $user->username) }}"
                               class="nav-link {{ Request::is('about-us') ? 'active' : '' }}">{{ __('messages.web_menu.about') }}</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">
                            <a href="{{ route('contact', $user->username) }}"
                               class="nav-link {{ Request::is('contact-us') ? 'active' : '' }}">{{ __('messages.web_home.contact') }}</a>
                        </li>
                        <ul class="dropdown-menu">
                            <li class="nav-item {{ Route::currentRouteName() == 'appointment' ? 'active' : '' }}">
                                    <a href="{{ route('appointment', $user->username) }}"
                                       class="nav-link {{ Request::is('appointment', $user->username) ? 'active' : '' }}">{{ __('messages.web_menu.appointment') }}</a>
                                </li>

                                <li class="nav-item {{ Route::currentRouteName() == 'working-hours' ? 'active' : '' }}">
                                    <a href="{{ route('working-hours', $user->username) }}"
                                       class="nav-link {{ Request::is('working-hours') ? 'active' : '' }}">{{ __('messages.web_menu.working_hours') }}</a>
                                </li>

                                <li class="nav-item {{ Route::currentRouteName() == 'testimonials' ? 'active' : '' }}">
                                    <a href="{{ route('testimonials', $user->username) }}"
                                       class="nav-link {{ Request::is('testimonial') ? 'active' : '' }}">{{ __('messages.web_home.testimonials') }}</a>
                                </li>

                                <li class="nav-item {{ Route::currentRouteName() == 'terms-of-service' ? 'active' : '' }}">
                                    <a href="{{ route('terms-of-service', $user->username) }}"
                                       class="nav-link {{ Request::is('terms-of-service') ? 'active' : '' }}">{{ __('messages.web_home.terms_of_service') }}</a>
                                </li>

                                <li class="nav-item {{ Route::currentRouteName() == 'privacy-policy' ? 'active' : '' }}">
                                    <a href="{{ route('privacy-policy', $user->username) }}"
                                       class="nav-link {{ Request::is('privacy-policy') ? 'active' : '' }}">{{ __('messages.web_home.privacy_policy') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <span class="d-flex align-items-center">
                                <i class="fas fa-language d-xl-block d-none me-2"></i>
                                <a href="javascript:void(0)"> {{getCurrentLanguageName()}}</a>
                            </span>
                            <ul class="dropdown-menu">
                                @foreach(getLanguages() as $key => $value)
                                    @foreach(\App\Models\User::LANGUAGES_IMAGE as $imageKey=> $imageValue)
                                        @if($imageKey == $key)
                                            <li class="nav-item languageSelection" data-prefix-value="{{ $key }}">
                                                <a href="javascript:void(0)">
                                                    <img class="rounded-1 ms-2 me-2 country-flag"
                                                         src="{{asset($imageValue)}}"/>
                                                    <span class="">{{ $value }}</span> </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        </li>
                    </ul>

                    <div class="others-options d-flex align-items-center">
                        @if(Auth::user())
                            @role('Admin')
                            <div class="option-item">
                                <a href="{{ route('dashboard') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Patient')
                            <div class="option-item">
                                <a href="{{ url('patient/my-cases') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Doctor')
                            <div class="option-item">
                                <a href="{{ url('employee/doctor') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Nurse')
                            <div class="option-item">
                                <a href="{{ url('bed-types') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Receptionist')
                            <div class="option-item">
                                <a href="{{  url('appointments') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Pharmacist')
                            <div class="option-item">
                                <a href="{{ url('employee/doctor') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Accountant')
                            <div class="option-item">
                                <a href="{{ url('accounts') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Case Manager')
                            <div class="option-item">
                                <a href="{{ url('employee/doctor') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Lab Technician')
                            <div class="option-item">
                                <a href="{{ url('employee/doctor') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                        @else
                            <div class="option-item">
                                <a href="{{ route('login') }}"
                                   class="default-btn">{{ __('messages.web_menu.login') }}</a>
                            </div>
                        @endif
                        <div class="option-item">
                            <form action="{{route('appointment', $user->username)}}" class="book-appointment-form"
                                  method="POST">
                                @csrf
                                <button type="submit"
                                        class="default-btn border-0">{{ __('messages.web_home.book_appointment') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>

            <div class="container">
                <div class="option-inner">
                    <div class="others-options d-flex align-items-center">
                        @if(Auth::user())
                            @role('Admin')
                            <div class="option-item text-center">
                                <a href="{{ route('dashboard') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Patient')
                            <div class="option-item text-center">
                                <a href="{{ url('patient/my-cases') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Doctor')
                            <div class="option-item text-center">
                                <a href="{{ url('employee/doctor') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Nurse')
                            <div class="option-item text-center">
                                <a href="{{ url('bed-types') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Receptionist')
                            <div class="option-item text-center">
                                <a href="{{  url('appointments') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Pharmacist')
                            <div class="option-item text-center">
                                <a href="{{ url('employee/doctor') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Accountant')
                            <div class="option-item text-center">
                                <a href="{{ url('accounts') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Case Manager')
                            <div class="option-item text-center">
                                <a href="{{ url('employee/doctor') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                            @role('Lab Technician')
                            <div class="option-item text-center">
                                <a href="{{ url('employee/doctor') }}"
                                   class="default-btn">{{ __('messages.dashboard.dashboard') }}</a>
                            </div>
                            @endrole
                        @else
                            <div class="option-item text-center">
                                <a href="{{ route('login') }}"
                                   class="default-btn">{{ __('messages.web_menu.login') }}</a>
                            </div>
                        @endif
                        <div class="option-item">
                            <form action="{{route('appointment', $user->username)}}" class="book-appointment-form"
                                  method="POST">
                                @csrf
                                <button type="submit"
                                        class="default-btn border-0">{{ __('messages.web_home.book_appointment') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
