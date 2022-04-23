@extends('web.layouts.front')
@section('title')
    {{ __('messages.contact_us') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contacts/contact.css') }}">
    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/selectize-input.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@php
    $enquiry = request()->query('enquiry');
    $hospitalSettingValue = getSettingValue();
@endphp
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.contact') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.contact') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-5.png') }}" data-aos="fade-left"
                     data-aos-delay="80"
                     data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Contact Info Area -->
    <div class="contact-info-area ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 contact-box">
                    <div class="contact-info-box h-100">
                        <div class="icon">
                            <i class="ri-phone-fill"></i>
                        </div>
                        <h3>
                            <a href="tel:{{ $hospitalSettingValue['hospital_phone']['value'] }}">{{ $hospitalSettingValue['hospital_phone']['value'] }}</a>
                        </h3>
                        <span>{{ __('messages.web_contact.call_today') }}</span>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 contact-box">
                    <div class="contact-info-box h-100">
                        <div class="icon">
                            <i class="ri-time-line"></i>
                        </div>
                        <h3>{{ $hospitalSettingValue['hospital_from_time']['value'] }}</h3>
                        <span>{{ __('messages.web_contact.open_hours') }}</span>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 contact-box">
                    <div class="contact-info-box contact-address h-100">
                        <div class="icon">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <h3>
                            {{ $hospitalSettingValue['hospital_address']['value'] }}
                            <span class="d-lg-block d-none">{{ $hospitalSettingValue['hospital_address']['value'] }}</span>
                        </h3>
                        <span>{{ __('messages.web_contact.our_location') }}</span>
                    </div>
                </div>

                <div class="contact-social-information">
                        <span>
                            <a href="mailto:{{ $hospitalSettingValue['hospital_email']['value'] }}">{{ $hospitalSettingValue['hospital_email']['value'] }}</a>
                        </span>

                    <ul class="social">
                        @if($hospitalSettingValue['facebook_url']['value'] != '' && !empty($hospitalSettingValue['facebook_url']['value']))
                            <li>
                                <a href="{{ $hospitalSettingValue['facebook_url']['value'] }}" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                        @endif
                        @if($hospitalSettingValue['twitter_url']['value'] != '' && !empty($hospitalSettingValue['twitter_url']['value']))
                            <li>
                                <a href="{{ $hospitalSettingValue['twitter_url']['value'] }}" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                        @endif
                        @if($hospitalSettingValue['instagram_url']['value'] != '' && !empty($hospitalSettingValue['instagram_url']['value']))
                            <li>
                                <a href="{{ $hospitalSettingValue['instagram_url']['value'] }}" target="_blank">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                        @endif
                        @if($hospitalSettingValue['linkedIn_url']['value'] != '' && !empty($hospitalSettingValue['linkedIn_url']['value']))
                            <li>
                                <a href="{{ $hospitalSettingValue['linkedIn_url']['value'] }}" target="_blank">
                                    <i class="ri-linkedin-line"></i>
                                </a>
                            </li>
                            @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Info Area -->
    <?php
    $userName = request()->segment(2);
    ?>
    <!-- Start Contact Area -->
    <div class="contact-area ptb-100">
        <div class="container">
            <div class="contact-form-wrap">
                <h3>{{ __('messages.web_contact.send_us_a_message') }}</h3>
                <form method="post" id="enquiryCreateForm" class="book-appointment-form">
                    @method('POST')
                    @csrf
                    <div class="ajax-message"></div>
                    <div class="row">
                        <input type="hidden" name="hospital_username" value="{{ request()->segment(2) }}">
                        <div class="form-group col-md-6">
                            <label>{{ __('messages.web_contact.your_name') }}</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" required
                                   data-error="Please enter your name"
                                   placeholder="{{ __('messages.web_contact.enter_your_name') }}">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('messages.web_contact.your_email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" required
                                   data-error="{{ __('messages.web_contact.enter_your_email') }}"
                                   placeholder="{{ __('messages.web_contact.enter_your_email') }}">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>{{ __('messages.web_contact.phone_number') }}</label>
                            <input type="tel"
                                   class="form-control {{ $errors->has('contact_no')?'is-invalid':'' }}"
                                   id="phoneNumber" name="contact_no" value="{{ old('contact_no') }}"
                                   placeholder="{{ __('messages.web_contact.contact_no') }}" required
                                   data-error="{{ __('messages.web_contact.please_enter_your_phone_number') }}"
                                   onkeyup='if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")'>
                            <div class="help-block with-errors"></div>
                            {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
                            <span id="valid-msg" class="hide">✓ Valid</span>
                            <span id="error-msg" class="hide"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ __('messages.web_contact.select_enquiry') }}</label>
                            <select name="type" class="general" id="general">
                                <option value="1">{{ \App\Models\Enquiry::TYPE_GENERAL }}</option>
                                <option value="2">{{ \App\Models\Enquiry::TYPE_FEEDBACK }}</option>
                                <option value="3">{{ \App\Models\Enquiry::TYPE_RESIDENTIAL }}</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('messages.web_contact.your_message') }}</label>
                        <textarea name="message" class="form-control" id="message" cols="30" rows="6" required
                                  data-error="{{ __('messages.web_contact.write_your_message') }}"
                                  placeholder="{{ __('messages.web_contact.type_your_message') }}"></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                    @if(getSettingForReCaptcha($userName))
                        <div class="form-group col-xl-12 mt-2">
                            @if(config('app.recaptcha.key'))
                                <div class="g-recaptcha" data-sitekey="{{config('app.recaptcha.key')}}">
                                </div>
                            @endif
                        </div>
                    @endif
                    <button type="submit" id="btnContact"
                            class="default-btn">{{ __('messages.web_contact.send_message') }}</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Contact Area -->
@endsection
@section('page_scripts')
    <script>
        let isEdit = false;
        let utilsScript = "{{ asset('assets/js/int-tel/js/utils.min.js') }}";
        let enquiryURl = "{{ route('send.enquiry', getUser()->username) }}";
    </script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script src="{{ asset('assets/js/int-tel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/int-tel/js/utils.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
    <script src="{{ asset('assets/js/web/contact_us.js') }}"></script>
    @if(getSettingForReCaptcha($userName))
        <script>
            let isGoogleCaptchaEnabled = {{ getSettingForReCaptcha($userName) }};
        </script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endsection
