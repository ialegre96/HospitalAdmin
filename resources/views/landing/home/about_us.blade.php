@extends('landing.layouts.app')
@section('title')
    {{ __('messages.web_home.about_us') }}
@endsection
@section('page_css')
    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <section class="page-title overflow-hidden position-relative text-center text-lg-start" data-bg-color="#d2f9fe">
        <div class="page-title-pattern topBottom"
             data-bg-img="{{asset('assets/landing-theme/images/bg/01.png')}}"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="title"><span>{{ __('messages.web_home.about_us') }}</span></h1>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">{{ __('messages.web_home.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.web_home.about_us') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="page-content">

        <section class="text-center position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="section-title">
                            <h2 class="title">{{ $landingAboutUs['text_main'] }}</span></h2>
                            <div class="title-bdr">
                                <div class="left-bdr"></div>
                                <div class="right-bdr"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="work-process">
                            <div class="step-num-box">
                                <div class="step-icon"><span>
                                        <img src="{{ isset($landingAboutUs['card_img_one']) ? asset($landingAboutUs['card_img_one']) : '' }}" alt="" width="40" height="40">
                                    </span>
                                </div>
                                <div class="arrow">
                                    <div class="curve"></div>
                                    <div class="point"></div>
                                </div>
                            </div>
                            <div class="step-desc">
                                <div class="step-num">01</div>
                                <h4>{{ $landingAboutUs['card_one_text'] }}</h4>
                                <p class="mb-0">{!! $landingAboutUs['card_one_text_secondary'] !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                        <div class="work-process">
                            <div class="step-num-box">
                                <div class="step-icon"><span>
                                        <img src="{{ isset($landingAboutUs['card_img_two']) ? asset($landingAboutUs['card_img_two']) : '' }}"
                                             alt="" width="40" height="40">
                                    </span>
                                </div>
                                <div class="arrow">
                                    <div class="curve"></div>
                                    <div class="point"></div>
                                </div>
                            </div>
                            <div class="step-desc">
                                <div class="step-num">02</div>
                                <h4>{{ $landingAboutUs['card_two_text'] }}</h4>
                                <p class="mb-0">{!! $landingAboutUs['card_two_text_secondary']  !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                        <div class="work-process">
                            <div class="step-num-box">
                                <div class="step-icon"><span>
                                        <img src="{{ isset($landingAboutUs['card_img_three']) ? asset($landingAboutUs['card_img_three']) : '' }}"
                                             alt="" width="40" height="40">
                                    </span>
                                </div>
                            </div>
                            <div class="step-desc">
                                <div class="step-num">03</div>
                                <h4>{{ $landingAboutUs['card_three_text'] }}</h4>
                                <p class="mb-0">{!! $landingAboutUs['card_three_text_secondary'] !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="position-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 order-lg-12 image-column right">
                        <div class="image-anim">
                            <img class="img-fluid" src="{{ isset($landingAboutUs['main_img_one']) ? asset($landingAboutUs['main_img_one']) : '' }}" alt="">
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12 order-lg-1 mt-5 mt-lg-0">
                        <div class="row">
                            <div class="col-md-6 mt-5">
                                <div class="featured-item style-4">
                                    <div class="featured-icon">
                                        <img src="{{ isset($sectionFour['img_url_one']) ? asset($sectionFour['img_url_one']) : '' }}"
                                             alt="" width="40" height="40">
                                    </div>
                                    <div class="featured-title">
                                        <h5>{{ $sectionFour['card_text_one'] }}</h5>
                                    </div>
                                    <div class="featured-desc">
                                        <p>{!! $sectionFour['card_text_one_secondary'] !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5 mt-md-0">
                                <div class="featured-item style-4">
                                    <div class="featured-icon">
                                        <img src="{{ isset($sectionFour['img_url_two']) ? asset($sectionFour['img_url_two']) : '' }}"
                                             alt="" width="40" height="40">
                                    </div>
                                    <div class="featured-title">
                                        <h5>{{ $sectionFour['card_text_two'] }}</h5>
                                    </div>
                                    <div class="featured-desc">
                                        <p>{!! $sectionFour['card_text_two_secondary'] !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="featured-item style-4">
                                    <div class="featured-icon">
                                        <img src="{{ isset($sectionFour['img_url_three']) ? asset($sectionFour['img_url_three']) : '' }}"
                                             alt="" width="40" height="40">
                                    </div>
                                    <div class="featured-title">
                                        <h5>{{ $sectionFour['card_text_three'] }}</h5>
                                    </div>
                                    <div class="featured-desc">
                                        <p>{!! $sectionFour['card_text_three_secondary'] !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5 mt-md-0">
                                <div class="featured-item style-4">
                                    <div class="featured-icon">
                                        <img src="{{ isset($sectionFour['img_url_four']) ? asset($sectionFour['img_url_four']) : '' }}"
                                             alt="" width="40" height="40">
                                    </div>
                                    <div class="featured-title">
                                        <h5>{{ $sectionFour['card_text_four'] }}</h5>
                                    </div>
                                    <div class="featured-desc">
                                        <p>{!! $sectionFour['card_text_four_secondary'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="position-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 position-relative">
                        <div class="effect-img">
                            <img class="img-fluid rotateme" src="{{asset('assets/landing-theme/images/bg/08.png')}}" alt="">
                        </div>
                        <img class="img-fluid" src="{{ isset($landingAboutUs['main_img_two']) ? ($landingAboutUs['main_img_two']) : '' }}" alt="">
                    </div>
                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                        <div id="accordion" class="accordion style-1">
                            @foreach($faqs as $faq)
                                <div class="card {{$loop->first ? 'active' : ''}}">
                                    <div class="card-header">
                                        <h6 class="mb-0">
                                            <a data-bs-toggle="collapse" data-bs-parent="#accordion"
                                               href="#collapse{{$faq->id}}"
                                               aria-expanded="{{$loop->first ? 'true' : 'false'}}">{{$faq->question}}</a>
                                        </h6>
                                    </div>
                                    <div id="collapse{{$faq->id}}" class="collapse {{$loop->first ? 'show' : ''}}"
                                         data-bs-parent="#accordion">
                                        <div class="card-body">{!! $faq->answer !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grey-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="counter">
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
                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="counter">
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
                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="counter">
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
                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="counter">
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
    <script src="//js.stripe.com/v3/"></script>
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
