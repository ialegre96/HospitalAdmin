@extends('landing.layouts.app')
@section('title')
    {{ __('messages.services') }}
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
                    <h1 class="title"><span>{{ __('messages.services') }}</span></h1>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">{{ __('messages.web_home.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.services') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="page-content">

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                        <div class="featured-item style-4 h-100">
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
                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                        <div class="featured-item style-4 h-100">
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
                    <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
                        <div class="featured-item style-4 h-100">
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
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-4 h-100">
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
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-4 h-100">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionFour['img_url_five']) ? asset($sectionFour['img_url_five']) : '' }}"
                                     alt="" width="40" height="40">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionFour['card_text_five'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{!! $sectionFour['card_text_five_secondary'] !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-4 h-100">
                            <div class="featured-icon">
                                <img src="{{ isset($sectionFour['img_url_six']) ? asset($sectionFour['img_url_six']) : '' }}"
                                     alt="" width="40" height="40">
                            </div>
                            <div class="featured-title">
                                <h5>{{ $sectionFour['card_text_six'] }}</h5>
                            </div>
                            <div class="featured-desc">
                                <p>{!! $sectionFour['card_text_six_secondary'] !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grey-bg">
            <div class="container">
                <div class="row align-items-center owl-carousel">
                    @foreach($serviceSlider as $image)
                        <div class="col-10 mx-auto">
                            <div class="client-logo">
                                <img class="img-fluid custom-service-slider" src="{{asset($image->image_url)}}" alt="">
                            </div>
                        </div>
                    @endforeach
                    <div class="col-10 mx-auto mt-3 mt-sm-0">
                        <div class="client-logo">
                            <img class="img-fluid h-50px" src="{{asset('assets/landing-theme/images/client/02.png')}}"
                                 alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(getLoggedInUser() == null || !getLoggedInUser()->hasRole('Super Admin'))
            @include('landing.landing_pricing_plan.index', ['screenFrom' => Route::currentRouteName()])
        @endif

        <section class="position-relative">
            <div class="round-anim"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel" data-dots="false" data-nav="true" data-items="1" data-autoplay="true">
                            @foreach($testimonials as $testimonial)
                                <div class="item">
                                    <div class="testimonial style-2">
                                        <div class="testimonial-img">
                                            <img class="img-fluid"
                                                 src="{{asset(!empty($testimonial->image_url) ? $testimonial->image_url : 'assets/landing-theme/images/testimonial/01.jpg')}}"
                                                 alt="">
                                        </div>
                                        <div class="testimonial-content">
                                            <div class="testimonial-quote"><i class="fas fa-quote-left"></i>
                                            </div>
                                            <p>{!! $testimonial->description !!}</p>
                                            <div class="testimonial-caption">
                                                <h5>{{$testimonial->name}}</h5>
                                                <label>{{$testimonial->position}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
