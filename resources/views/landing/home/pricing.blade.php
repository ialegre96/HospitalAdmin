@extends('landing.layouts.app')
@section('title')
    {{ __('messages.landing.pricing') }}
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
                    <h1 class="title"><span>{{ __('messages.landing.pricing') }}</span></h1>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">{{ __('messages.landing.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.landing.pricing') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="page-content">
        @include('flash::message')
        <section>
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="section-title">
                            <h2 class="title"><span>{{ __('messages.landing.choose_your_pricing_plan') }}</span></h2>
                            <div class="title-bdr">
                                <div class="left-bdr"></div>
                                <div class="right-bdr"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('landing.landing_pricing_plan.index', ['screenFrom' => Route::currentRouteName()])
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
