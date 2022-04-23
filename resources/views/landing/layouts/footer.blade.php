@php 
    $settingValue = getSuperAdminSettingValue();
@endphp
<footer class="footer theme-bg">
    <div class="primary-footer">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-12">
                    <div>
                        <h2 class="title">{{ __('messages.landing.subscribe_our_newsletter') }}</h2>
                        <div class="title-bdr">
                            <div class="left-bdr"></div>
                            <div class="right-bdr"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center mb-4">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="ajax-message"></div>
                    <div class="subscribe-form">
                        <form id="mc-form" class="group d-md-flex align-items-center" method="POST">
                            @CSRF
                            <input type="email" value="" name="email" class="email" id="email"
                                   placeholder="Enter Email Address" required>
                            <button class="btn btn-theme" type="submit" id="subscribeBtn">
                                <span>{{__('messages.landing.subscribe')}}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-logo mb-3">
                        <img id="footer-logo-white-img" src="{{ $settingValue['app_logo']['value'] }}"
                             class="img-fluid" alt="">
                    </div>
                    <p class="mb-0">{!! $settingValue['footer_text']['value'] !!}</p>

                </div>
                <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                    <h4 class="mb-4 text-white">{{__('messages.landing.usefull_link')}}</h4>
                    <div class="footer-list justify-content-between d-flex">
                        <ul class="list-unstyled w-100">
                            <li><a href="{{ route('landing.home') }}">{{ __('messages.landing.home') }}</a>
                            </li>
                            <li><a href="{{ route('landing.about.us') }}">{{ __('messages.landing.about') }}</a>
                            </li>
                            <li><a href="{{ route('landing.services') }}">{{ __('messages.services') }}</a>
                            </li>
                        </ul>
                        <ul class="list-unstyled w-100">
                            @if(getLoggedInUser() == null || !getLoggedInUser()->hasRole('Super Admin'))
                                <li><a href="{{ route('landing.pricing') }}">{{ __('messages.landing.pricing') }}</a>
                                </li>
                            @endif
                            <li><a href="{{ route('landing.contact.us') }}">{{ __('messages.enquiry.contact') }}</a>
                            </li>
                            <li><a href="{{ route('landing.faq') }}">{{ __('messages.landing.faqs') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                    <div class="footer-cntct">
                        <h4 class="mb-4 text-white">{{ __('messages.landing.get_in_touch') }}</h4>
                        <ul class="media-icon list-unstyled">
                            <li>
                                <p class="mb-0"><i class="la la-map-o"></i>
                                    <b>{{ $settingValue['address']['value'] }}</b>
                                </p>
                            </li>
                            <li><i class="la la-envelope-o"></i> <a
                                        href="mailto:{{ $settingValue['email']['value'] }}"><b>{{ $settingValue['email']['value'] }}</b></a>
                            </li>
                            <li><i class="la la-phone"></i> <a
                                        href="tel:{{ $settingValue['phone']['value'] }}"><b>{{ $settingValue['phone']['value'] }}</b></a>
                            </li>
                        </ul>
                        <div class="social-icons mt-3">
                            <ul class="list-inline">
                                <li class="{{ empty($settingValue['facebook_url']['value']) ? 'd-none' : ''}}"><a
                                            href="{{ $settingValue['facebook_url']['value'] }}" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="{{ empty($settingValue['instagram_url']['value']) ? 'd-none' : ''}}"><a
                                            href="{{ $settingValue['instagram_url']['value'] }}"><i
                                                class="fab fa-instagram" target="_blank"></i></a>
                                </li>
                                <li class="{{ empty($settingValue['twitter_url']['value']) ? 'd-none' : ''}}"><a
                                            href="{{ $settingValue['twitter_url']['value'] }}"><i
                                                class="fab fa-twitter"
                                                target="_blank"></i></a>
                                </li>
                                <li class="{{ empty($settingValue['linkedin_url']['value']) ? 'd-none' : ''}}"><a
                                            href="{{ $settingValue['linkedin_url']['value'] }}"><i
                                                class="fab fa-linkedin-in" target="_blank"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="secondary-footer mt-5 text-center">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-12">
                        <span>
                            {{ __('messages.web_menu.copyright') }} © {{ date('Y') }} <b>{{ $settingValue['app_name']['value'] }}</b> | {{__('messages.landing.all_rights_reserved')}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
