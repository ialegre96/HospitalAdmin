@php 
    $settingValue = getSuperAdminSettingValue();
@endphp
<header id="site-header" class="header header-3">
    <div id="header-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand logo" href="{{ route('landing.home') }}">
                            <img id="logo-img" class="img-fluid"
                                 src="{{ $settingValue['app_logo']['value'] }}"
                                 alt="">
                        </a>
                        <div class="right-nav align-items-center d-sm-none d-flex justify-content-end right-sm-nav">
                            @if(!empty(getLoggedInUser()) && getLoggedInUser()->hasRole('Admin'))
                                <a class="btn btn-theme btn-sm" href="{{ route('dashboard') }}"><span>{{ __('Dashboard') }}</span></a>
                            @elseif(!empty(getLoggedInUser()) && getLoggedInUser()->hasRole('Super Admin'))
                                <a class="btn btn-theme btn-sm" href="{{ route('super.admin.dashboard') }}"><span>{{ __('Dashboard') }}</span></a>
                            @else
                                <a class="btn btn-theme btn-sm" href="{{ route('login') }}"><span>{{ __('messages.web_menu.login') }}</span></a>
                            @endif
                        </div>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                       href="{{ route('landing.home') }}">{{ __('messages.landing.home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('about-us') ? 'active' : '' }}"
                                       href="{{ route('landing.about.us') }}">{{ __('messages.landing.about') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('our-services') ? 'active' : '' }}"
                                       href="{{ route('landing.services') }}">{{ __('messages.services') }}</a>
                                </li>
                                @if(getLoggedInUser() == null || !getLoggedInUser()->hasRole('Super Admin'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('pricing') ? 'active' : '' }}"
                                           href="{{ route('landing.pricing') }}">{{ __('messages.landing.pricing') }}</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('contact-us') ? 'active' : '' }}"
                                       href="{{ route('landing.contact.us') }}">{{ __('messages.enquiry.contact') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('faqs') ? 'active' : '' }}"
                                       href="{{ route('landing.faq') }}">{{ __('messages.landing.faqs') }}</a>
                                </li>
                                <li class="nav-item language-dropdown d-flex align-items-center">
                                    <span class="d-flex align-items-center"> <i class="fas fa-language d-xl-block d-none 
                                        me-2"></i> <a href="javascript:void(0)"> {{getHeaderLanguageName()}}</a> 
                                    </span>
                                    <ul class="dropdown-menu">
                                    @foreach(getLanguages() as $key => $value) 
                                        @foreach(\App\Models\User::LANGUAGES_IMAGE as $imageKey=> $imageValue) 
                                            @if($imageKey == $key)
                                                <li class="nav-item languageSelection" data-prefix-value="{{ $key }}">
                                                    <a href="javascript:void(0)">
                                                    <img class="rounded-1 ms-2 me-2 country-flag" src="{{asset($imageValue)}}"/>
                                                    <span class="">{{ $value }}</span> </a>
                                                </li> 
                                            @endif
                                        @endforeach
                                    @endforeach 
                                    </ul>
                                </li>
                            </ul>
                            <div class="header-call d-flex align-items-center me-3 d-sm-none d-block header-sm-call">
                                <h5>{{ __('messages.landing.call') }}:</h5>
                                <a href="tel:{{$settingValue['phone']['value']}}"><b>{{$settingValue['phone']['value']}}</b></a>
                            </div>
                        </div>
                        <div class="right-nav align-items-center d-sm-flex justify-content-end d-none ms-auto me-3">
                            <div class="header-call d-flex align-items-center me-3">
                                <h5>{{ __('messages.landing.call') }}:</h5>
                                <a href="tel:{{$settingValue['phone']['value']}}"><b>{{ $settingValue['phone']['value'] }}</b></a>
                            </div>
                            @if(!empty(getLoggedInUser()) && getLoggedInUser()->hasRole('Admin'))
                                <a class="btn btn-theme btn-sm" href="{{ route('dashboard') }}"><span>{{ __('Dashboard') }}</span></a>
                            @elseif(!empty(getLoggedInUser()) && getLoggedInUser()->hasRole('Super Admin'))
                                <a class="btn btn-theme btn-sm" href="{{ route('super.admin.dashboard') }}"><span>{{ __('Dashboard') }}</span></a>
                            @else
                                <a class="btn btn-theme btn-sm" href="{{ route('login') }}"><span>{{ __('messages.web_menu.login') }}</span></a>
                            @endif
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNavDropdown" aria-expanded="false"
                                aria-label="Toggle navigation"><span class="menu-line"></span>
                            <span class="menu-line"></span>
                            <span class="menu-line"></span>
                            <span class="line-one"></span>
                            <span class="line-two"></span>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
