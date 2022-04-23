@extends('landing.layouts.app')
@section('title')
    {{ __('messages.web_home.home') }}
@endsection
@section('page_css')
    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <section id="home" class="banner p-0 position-relative fullscreen-banner">
        <div class="hero-shape3">
            <img class="img-fluid" src="{{asset('assets/landing-theme/images/bg/04.png')}}" alt="">
        </div>
        <div class="align-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-12 order-lg-1 image-anim">
                        <div class="wow fadeInRight" data-wow-duration="2.5s">
                            <img class="img-fluid"
                                 src="{{ isset($sectionOne['img_url']) ? asset($sectionOne['img_url']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}"
                                 alt="">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 mt-5 mt-lg-0 wow fadeInLeft ms-auto" data-wow-duration="2.5s">
                        <h1 class="mb-4 font-w-4">{{ $sectionOne['text_main'] }}
                        </h1>
                        @if(!getLoggedInUser())
                        <p class="lead mb-4">{{ $sectionOne['text_secondary'] }}</p> <a class="btn btn-theme"
                                                                                        href="{{ route('register') }}"><span>{{ __('messages.web_home.sign_up') }}</span></a>
                        @endif
                        <a class="btn btn-dark"
                           href="{{ route('landing.contact.us') }}"><span>{{ __('messages.contact_us') }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-content">

        <section class="section-container">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="section-title">
                            <h2 class="title">{{ $sectionTwo['text_main'] }}</h2>
                            <div class="title-bdr">
                                <div class="left-bdr"></div>
                                <div class="right-bdr"></div>
                            </div>
                            <p>{{ $sectionTwo['text_secondary'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="featured-item">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionTwo['card_one_image']) ? asset($sectionTwo['card_one_image']) : ''}}"
                                     alt="" class="home-section-two-img">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionTwo['card_one_text'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionTwo['card_one_text_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                        <div class="featured-item">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionTwo['card_two_image']) ? asset($sectionTwo['card_two_image']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}"
                                     alt="" class="home-section-two-img">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionTwo['card_two_text'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionTwo['card_two_text_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                        <div class="featured-item">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionTwo['card_third_image']) ? asset($sectionTwo['card_third_image']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}"
                                     alt="" class="home-section-two-img">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionTwo['card_third_text'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionTwo['card_third_text_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="position-relative py-15 z-index-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-12 image-column p-0 pe-lg-5">
                        <div class="effect-img">
                            <img class="img-fluid rotateme" src="{{asset('assets/landing-theme/images/bg/08.png')}}"
                                 alt="">
                        </div>
                        <img class="img-fluid"
                             src="{{ isset($sectionThree['img_url']) ? asset($sectionThree['img_url']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}"
                             alt="">
                    </div>
                    <div class="col-lg-5 col-md-12 ms-auto mt-5 mt-lg-0">
                        <div class="section-title">
                            <h2 class="title">{{ $sectionThree['text_main'] }}</h2>
                            <div class="title-bdr">
                                <div class="left-bdr"></div>
                                <div class="right-bdr"></div>
                            </div>
                            <p class="text-black">{{ $sectionThree['text_secondary'] }}</p>
                        </div>
                        <ul class="list-unstyled list-icon mb-5">
                            <li class="mb-3"><i class="fas fa-check-circle"></i> {{ $sectionThree['text_one'] }}</li>
                            <li class="mb-3"><i class="fas fa-check-circle"></i> {{ $sectionThree['text_two'] }}</li>
                            <li class="mb-3 {{ isset($sectionThree['text_three']) ? '' : 'd-none' }}">
                                <i class="fas fa-check-circle"></i> {{ isset($sectionThree['text_three']) ? $sectionThree['text_three'] : '' }}
                            </li>
                            <li class="mb-3 {{ isset($sectionThree['text_four']) ? '' : 'd-none' }}">
                                <i class="fas fa-check-circle"></i> {{ isset($sectionThree['text_four']) ? $sectionThree['text_four'] : '' }}
                            </li>
                            <li class="mb-3 {{ isset($sectionThree['text_five']) ? '' : 'd-none' }}">
                                <i class="fas fa-check-circle"></i> {{ isset($sectionThree['text_five']) ? $sectionThree['text_five'] : '' }}
                            </li>
                        </ul>
                        <a class="btn btn-theme btn-circle"
                           href="{{ route('landing.contact.us') }}"><span>{{ __('messages.contact_us') }}</span></a>
                        <a class="btn btn-white btn-circle"
                           href="{{ route('register') }}"><span>{{ __('messages.web_home.sign_up') }}</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section id="services">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="section-title">
                            <h2 class="title">{{ $sectionFour['text_main'] }}</h2>
                            <div class="title-bdr">
                                <div class="left-bdr"></div>
                                <div class="right-bdr"></div>
                            </div>
                            <p>{{ $sectionFour['text_secondary'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="featured-item style-3">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionFour['img_url_one']) ? asset($sectionFour['img_url_one']) : ''}}"
                                     alt="" width="50" height="50">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionFour['card_text_one'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionFour['card_text_one_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                        <div class="featured-item style-3">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionFour['img_url_two']) ? asset($sectionFour['img_url_two']) : ''}}"
                                     alt="" width="50" height="50">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionFour['card_text_two'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionFour['card_text_two_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
                        <div class="featured-item style-3">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionFour['img_url_three']) ? asset($sectionFour['img_url_three']) : ''}}"
                                     alt="" width="50" height="50">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionFour['card_text_three'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionFour['card_text_three_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-3">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionFour['img_url_four']) ? asset($sectionFour['img_url_four']) : ''}}"
                                     alt="" width="50" height="50">
                            </div>
                            <div class="featured-title">
                                <h5>{!! $sectionFour['card_text_four'] !!}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionFour['card_text_four_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-3">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionFour['img_url_five']) ? asset($sectionFour['img_url_five']) : ''}}"
                                     alt="" width="50" height="50">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionFour['card_text_five'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionFour['card_text_five_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-3">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionFour['img_url_six']) ? asset($sectionFour['img_url_six']) : ''}}"
                                     alt="" width="50" height="50">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionFour['card_text_six'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $sectionFour['card_text_six_secondary'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ourHospital">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="section-title">
                            <h2 class="title">{{ __('messages.our_hospitals') }}</h2>
                            <div class="title-bdr">
                                <div class="left-bdr"></div>
                                <div class="right-bdr"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center g-4">
                    @foreach($hospitals as $hospital)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('front',$hospital->username) }}">
                                <div class="featured-item style-3 flex-column">
                                    <div class="featured-icon d-block">
                                        <img src="{{ isset($hospital) ? asset($hospital['image_url']) : ''}}"
                                             alt="" width="70" height="70">
                                    </div>
                                    <div>
                                        <div class="featured-title">
                                            <h5 class="mb-2">{{ $hospital->full_name }}</h5>
                                        </div>
                                        <div class="featured-desc">
                                            <p>{{ $hospital->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    {{ $hospitals->links() }}
                </div>
            </div>
        </section>
        
        <section class="position-relative bg-contain bg-pos-rb"
                 data-bg-img="{{asset('assets/landing-theme/images/bg/07.png')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 image-column p-0 pe-lg-5">
                        <img class="img-fluid"
                             src="{{ isset($sectionFive['main_img_url']) ? asset($sectionFive['main_img_url']) : ''}}"
                             alt="">
                    </div>
                    <div class="col-lg-6 col-md-12 ms-auto mt-md-0 mt-5">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="counter h-100">
                                    <div class="counter-icon">
                                        <img src="{{ isset($sectionFive['card_img_url_one']) ? asset($sectionFive['card_img_url_one']) : ''}}"
                                             width="70" height="70" alt="">
                                    </div>
                                    <div class="counter-desc"><span class="count-number"
                                                                    data-to="{{$sectionFive['card_one_number']}}"
                                                                    data-speed="1000">{{$sectionFive['card_one_number']}}</span>
                                        <h5>{{$sectionFive['card_one_text']}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-5 mt-md-0 text-end">
                                <div class="counter h-100">
                                    <div class="counter-icon">
                                        <img src="{{ isset($sectionFive['card_img_url_two']) ? asset($sectionFive['card_img_url_two']) : ''}}"
                                             width="70" height="70" alt="">
                                    </div>
                                    <div class="counter-desc"><span class="count-number"
                                                                    data-to="{{$sectionFive['card_two_number']}}"
                                                                    data-speed="1000">{{$sectionFive['card_two_number']}}</span>
                                        <h5>{{$sectionFive['card_two_text']}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-5">
                                <div class="counter h-100">
                                    <div class="counter-icon">
                                        <img src="{{ isset($sectionFive['card_img_url_three']) ? asset($sectionFive['card_img_url_three']) : ''}}"
                                             width="70" height="70" alt="">
                                    </div>
                                    <div class="counter-desc"><span class="count-number"
                                                                    data-to="{{$sectionFive['card_three_number']}}"
                                                                    data-speed="1000">{{$sectionFive['card_three_number']}}</span>
                                        <h5>{{$sectionFive['card_three_text']}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-5">
                                <div class="counter h-100">
                                    <div class="counter-icon">
                                        <img src="{{ isset($sectionFive['card_img_url_four']) ? asset($sectionFive['card_img_url_four']) : ''}}"
                                             width="70" height="70" alt="">
                                    </div>
                                    <div class="counter-desc"><span class="count-number"
                                                                    data-to="{{$sectionFive['card_four_number']}}"
                                                                    data-speed="1000">{{$sectionFive['card_four_number']}}</span>
                                        <h5>{{$sectionFive['card_four_text']}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(getLoggedInUser() == null || !getLoggedInUser()->hasRole('Super Admin'))
            @include('landing.landing_pricing_plan.index', ['screenFrom' => Route::currentRouteName()])
        @endif

    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/jquery.toast.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let getLoggedInUserdata = "{{ getLoggedInUser() }}";
        let logInUrl = "{{ url('login') }}";
        let fromPricing = true;
        let makePaymentURL = "{{ route('purchase-subscription') }}";
        let subscribeText = "{{ __('messages.subscription_pricing_plans.choose_plan') }}";
        let toastData = JSON.parse('@json(session('toast-data'))');
    </script>
    <script src="{{ mix('assets/js/subscriptions/free-subscription.js') }}"></script>
    <script src="{{ mix('assets/js/subscriptions/payment-message.js') }}"></script>
@endsection
