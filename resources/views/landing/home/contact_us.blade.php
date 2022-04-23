@extends('landing.layouts.app')
@section('title')
    Contact Us
@endsection
@section('page_css')
    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @php
        $settingValue = getSuperAdminSettingValue();
    @endphp
    <section class="page-title overflow-hidden position-relative text-center text-lg-start" data-bg-color="#d2f9fe">
        <div class="page-title-pattern topBottom"
             data-bg-img="{{asset('assets/landing-theme/images/bg/01.png')}}"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="title"><span>{{ __('messages.contact_us') }}</span></h1>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">{{ __('messages.landing.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.contact_us') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="page-content">
        <section>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-12">
                        <img class="img-fluid mb-7" src="{{asset('assets/landing-theme/images/svg/contact-us.svg')}}"
                             alt="">
                        <div class="contact-media">
                            <div class="d-flex align-items-center mb-5">
                                <div class="flex-shrink-0"><i class="la la-map-o"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>{{ __('messages.common.address') }}</h5>
                                    <p>{{ $settingValue['address']['value'] }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-5">
                                <div class="flex-shrink-0"><i class="la la-envelope-o"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>{{ __('messages.enquiry.email') }}</h5>
                                    <a href="mailto:{{ $settingValue['email']['value'] }}">{{ $settingValue['email']['value'] }}</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0"><i class="la la-phone"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>{{ __('messages.case.phone') }}</h5>
                                    <a href="tel:{{ $settingValue['phone']['value'] }}">{{ $settingValue['phone']['value'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 mt-5 mt-lg-0">
                        <div class="contact-inner white-bg">
                            <div class="section-title">
                                <h2 class="title"><span>{{ __('messages.contact_us') }}</span></h2>
                                <div class="title-bdr">
                                    <div class="left-bdr"></div>
                                    <div class="right-bdr"></div>
                                </div>
                                <p>Get in touch and let us know how we can help. Fill out the form and we’ll be in touch
                                    as soon as possible.</p>
                            </div>
                            <form id="contactEnquiryForm" method="POST">
                                @method('POST')
                                @csrf
                                <div class="ajax-message"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="firstName" type="text" name="first_name" class="form-control"
                                                   placeholder="First name" required="required"
                                                   data-error="Firstname is required.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="lastName" type="text" name="last_name" class="form-control"
                                                   placeholder="Last name" required="required"
                                                   data-error="Lastname is required.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="email" type="email" name="email" class="form-control"
                                                   placeholder="Email" required="required"
                                                   data-error="Valid email is required.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="phone" type="tel" name="phone" class="form-control"
                                                   placeholder="Phone" required="required"
                                                   data-error="Phone is required">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="message" name="message" class="form-control"
                                                      placeholder="Message" rows="3" required="required"
                                                      data-error="Please,leave us a message."></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @if(config('app.recaptcha.key'))
                                            <div class="form-group mb-4">
                                                <div class="g-recaptcha" data-sitekey="{{config('app.recaptcha.key')}}">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <button class="btn btn-theme btn-circle">
                                            <span>{{ __('messages.web_contact.send_message') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ mix('assets/js/super_admin/contact_enquiry/contact_enquiry.js') }}"></script>
@endsection
