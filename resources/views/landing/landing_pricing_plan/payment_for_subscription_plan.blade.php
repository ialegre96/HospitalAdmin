@extends('landing.layouts.app')
@section('title')
    {{__('messages.subscription_plans.payment_type')}}
@endsection
@section('page_css')
    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="page-content">
        <section>
            <br/><br/><br/>
            <div class="container-fluid">

                {{--
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12 col-md-12">
                        <h4 class="text-center my-3 mb-6">{{__('messages.subscription_plans.payment_type')}}</h4>
                    </div>

                    @if(!currentActiveSubscription()->isExpired())
                        @php
                            $planData = getProratedPlanData($subscriptionsPricingPlan->id);
                        @endphp
                        <div class="col-xl-6 m-auto">
                            <div class="card card-bordered mb-4 mt-0">
                                <div class="card-header ribbon ribbon-end position-relative py-4">
                                    <div class="card-title mb-0 fs-5">{{ __('messages.subscription_plans.remaining_balance') }}</div>
                                    <div class="ribbon-label bg-primary fs-4">{{ $planData['remainingBalance'] }}</div>
                                </div>
                            </div>
                            <div class="card card-bordered mb-4">
                                <div class="card-header ribbon ribbon-end position-relative py-4">
                                    <div class="card-title mb-0 fs-5">{{ __('messages.subscription_plans.amount_to_pay') }}</div>
                                    <div class="ribbon-label bg-info fs-4">{{ $planData['amountToPay'] }}</div>
                                </div>
                            </div>
                            <div class="card card-bordered">
                                <div class="card-header ribbon ribbon-end position-relative py-4">
                                    <div class="card-title mb-0 fs-5">{{ __('messages.subscription_plans.used_days') }}</div>
                                    <div class="ribbon-label bg-success fs-4">{{ $planData['usedDays'] }}</div>
                                </div>
                            </div>
                            @if ( $planData['totalExtraDays'] > 0)
                                <div class="card card-bordered">
                                    <div class="card-header ribbon ribbon-end position-relative py-4">
                                        <div class="card-title mb-0 fs-5">{{ __('messages.subscription_plans.total_extra_days') }}</div>
                                        <div class="ribbon-label bg-success fs-4">{{ $planData['totalExtraDays'] }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="{{ currentActiveSubscription()->isExpired() ? 'col-xl-4 my-4' : 'col-xl-6' }}">
                        <div class="price-table">
                            <div class="price-header">
                                <h3 class="price-title">{{ $subscriptionsPricingPlan->name }}</h3>
                                <div class="price-value">
                                    <h2>
                                        <span>{{ getSubscriptionPlanCurrencyIcon($subscriptionsPricingPlan->currency) }}</span>{{ number_format($subscriptionsPricingPlan->price) }}
                                    </h2>
                                    <span>{{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionsPricingPlan->frequency] }}</span>
                                </div>
                            </div>
                            @if($subscriptionsPricingPlan->trial_days != 0)
                                <div class="price-list">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h4>{{ __('messages.subscription_plans.valid_until') }}
                                                : {{ $subscriptionsPricingPlan->trial_days }}
                                                <span>{{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionsPricingPlan->frequency] }}</span>
                                            </h4>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            <div class="mt-2 d-flex justify-content-center {{ $planData['totalExtraDays'] > 0 ? 'd-none' : '' }}">
                                {{ Form::select('payment_type', $paymentTypes, \App\Models\Subscription::TYPE_STRIPE, ['required', 'id' => 'paymentType']) }}
                            </div>
                            <div class="mt-5 stripePayment proceed-to-payment">
                                <button type="button"
                                        class="btn btn-primary rounded-pill mx-auto d-block makePayment"
                                        data-id="{{ $subscriptionsPricingPlan->id }}"
                                        data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                    <span>{{ __('messages.subscription_pricing_plans.proceed_to_payment') }}</span>
                                </button>
                            </div>
                            <div class="mt-5 paypalPayment proceed-to-payment d-none">
                                <button type="button"
                                        class="btn btn-primary rounded-pill mx-auto d-block paymentByPaypal"
                                        data-id="{{ $subscriptionsPricingPlan->id }}"
                                        data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                    <span>{{ __('messages.subscription_pricing_plans.proceed_to_payment') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                --}}

                @php
                    $cpData = getCurrentPlanDetails();
                    $planText = ($cpData['isExpired']) ? 'Current Expired Plan' : 'Current Plan';
                    $currentPlan = $cpData['currentPlan'];
                @endphp


                <div class="card-body">
                    @include('flash::message')
                    <div class="row justify-content-center">
                        @if(currentActiveSubscription()->ends_at >= \Carbon\Carbon::now())
                            <div class="col-md-5 col-12 mb-md-0 mb-10">
                                <div class="card plan-card-shadow h-100 card-xxl-stretch p-5 me-md-2">
                                    <div class="card-header border-0 px-0 bg-transparent">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bolder text-primary fs-3 mb-1 me-0">{{$planText}}</span>
                                        </h3>
                                        <hr/>
                                    </div>
                                    <div class="card-body pt-0 pb-3 px-0">
                                        <div class="flex-stack">
                                            <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">Plan Name</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['name']}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-3 text-gray-800 fw-bolder">Plan Price</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">
                                        <span class="mb-2">
                                            {{ getSubscriptionPlanCurrencyIcon($currentPlan->currency) }}
                                        </span>
                                        {{ number_format($currentPlan->price) }}
                                    </span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">Start Date</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['startAt']}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">End Date</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['endsAt']}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">Used Days</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['usedDays']}} Days</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">Remaining Days</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['remainingDays']}} Days</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">Used Balance</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">
                                        <span class="mb-2">
                                            {{ getSubscriptionPlanCurrencyIcon($currentPlan->currency) }}
                                        </span>
                                        {{$cpData['usedBalance']}}
                                    </span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">Remaining
                                                Balance</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">
                                        <span class="mb-2">{{ getSubscriptionPlanCurrencyIcon($currentPlan->currency) }}</span>
                                        {{$cpData['remainingBalance']}}
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @php
                            $newPlan = getProratedPlanData($subscriptionsPricingPlan->id);
                        @endphp
                        <div class="col-md-5 col-12">
                            <div class="card plan-card-shadow h-100 card-xxl-stretch p-5 ms-md-2">
                                <div class="card-header border-0 px-0 bg-transparent">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder text-primary fs-3 mb-1 me-0">New Plan</span>
                                    </h3>
                                    <hr/>
                                </div>
                                <div class="card-body pt-0 pb-3 px-0">
                                    <div class="flex-stack">
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">Plan Name</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">{{$newPlan['name']}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">Plan Price</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">
                                        <span class="mb-2">
                                            {{ getSubscriptionPlanCurrencyIcon($subscriptionsPricingPlan->currency) }}
                                        </span>
                                        {{ number_format($subscriptionsPricingPlan->price) }}
                                    </span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">Start Date</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">{{ $newPlan['startDate'] }}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">End Date</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">{{$newPlan['endDate']}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">Total Days</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">{{$newPlan['totalDays']}} Days</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">Remaining
                                                Balance of
                                                Prev. Plan</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">
                                        {{ getSubscriptionPlanCurrencyIcon($subscriptionsPricingPlan->currency) }}
                                                {{$newPlan['remainingBalance']}}
                                    </span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">Payable
                                                Amount</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">
                                        {{ getSubscriptionPlanCurrencyIcon($subscriptionsPricingPlan->currency) }}
                                                {{$newPlan['amountToPay']}}
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center mt-5 plan-controls">
                            <div class="mt-5 me-3 d-flex justify-content-center w-50 {{ $newPlan['amountToPay'] <= 0 ? 'd-none' : '' }}">
                                {{ Form::select('payment_type', $paymentTypes, \App\Models\Subscription::TYPE_STRIPE, ['required', 'id' => 'paymentType']) }}
                            </div>
                            @if($transction)
                                <div class="mt-5 stripePayment proceed-to-payment">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block makePayment"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}" disabled>
                                    <span>
                                        {{ __('messages.subscription_plans.pay_or_switch_plan') }}
                                    </span>
                                    </button>
                                </div>
                                <div class="mt-5 paypalPayment proceed-to-payment d-none">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block paymentByPaypal"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}" disabled>
                                    <span>
                                        {{ __('messages.subscription_plans.pay_or_switch_plan') }}
                                    </span>
                                    </button>
                                </div>
                                <div class="mt-5 razorPayPayment proceed-to-razor-pay-payment d-none">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block razor_pay_payment"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}" disabled>
                                        {{ __('messages.subscription_plans.pay_or_switch_plan') }}</button>
                                </div>
                                <div class="mt-5 cashPayment proceed-to-cash-payment d-none">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block cash_payment"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}" disabled>
                                        {{ __('messages.subscription_plans.pay_or_switch_plan') }}</button>
                                </div>
                            @else
                                <div class="mt-5 stripePayment proceed-to-payment">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block makePayment"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                    <span>
                                        {{ __('messages.subscription_plans.pay_or_switch_plan') }}
                                    </span>
                                    </button>
                                </div>
                                <div class="mt-5 paypalPayment proceed-to-payment d-none">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block paymentByPaypal"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                    <span>
                                        {{ __('messages.subscription_plans.pay_or_switch_plan') }}
                                    </span>
                                    </button>
                                </div>
                                <div class="mt-5 razorPayPayment proceed-to-razor-pay-payment d-none">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block razor_pay_payment"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                        {{ __('messages.subscription_plans.pay_or_switch_plan') }}</button>
                                </div>
                                <div class="mt-5 cashPayment proceed-to-cash-payment d-none">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block cash_payment"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                        {{ __('messages.subscription_plans.pay_or_switch_plan') }}</button>
                                </div>
                            @endif
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
    <script src="//checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script>
        let getLoggedInUserdata = "{{ getLoggedInUser() }}";
        let logInUrl = "{{ url('login') }}";
        let fromPricing = "{{ $fromScreen }}";
        let makePaymentURL = "{{ route('purchase-subscription') }}";
        let subscribeText = "{{ __('messages.subscription_pricing_plans.choose_plan') }}";
        let stripe = Stripe('{{ config('services.stripe.key') }}');
        let toastData = JSON.parse('@json(session('toast-data'))');
        let subscriptionPlans = "{{ route('landing.home') }}";
        let makeRazorpayURl = "{{ route('razorpay.purchase.subscription') }}";
        let razorpayPaymentFailed = "{{ route('razorpay.failed') }} ";
        let razorpayPaymentFailedModal = "{{ route('razorpay.failed.modal') }}";
        let cashPaymentUrl = "{{ route('cash.pay.success') }}";
        let options = {
            'key': "{{ config('payments.razorpay.key') }}",
            'amount': 1, //  100 refers to 1 
            'currency': 'INR',
            'name': "{{getAppName()}}",
            'order_id': '',
            'description': '',
            'image': '{{ getLogoUrl() }}', // logo here
            'callback_url': "{{ route('razorpay.success') }}",
            'prefill': {
                'email': '', // recipient email here
                'name': '', // recipient name here
                'contact': '', // recipient phone here
            },
            'readonly': {
                'name': 'true',
                'email': 'true',
                'contact': 'true',
            },
            'modal': {
                'ondismiss': function () {
                    $.ajax({
                        type: 'POST',
                        url: razorpayPaymentFailedModal,
                        success: function (result) {
                            if (result.url) {
                                $.toast({
                                    heading: 'Success',
                                    icon: 'Success',
                                    bgColor: '#7603f3',
                                    textColor: '#ffffff',
                                    text: 'Payment not completed.',
                                    position: 'top-right',
                                    stack: false,
                                });
                                setTimeout(function () {
                                    window.location.href = result.url;
                                }, 3000)
                            }
                        },
                        error: function (result) {
                            displayErrorMessage(result.responseJSON.message);
                        },
                    });
                },
            },
        };
    </script>
    <script src="{{ mix('assets/js/subscriptions/subscription.js') }}"></script>
    <script src="{{ mix('assets/js/subscriptions/payment-message.js') }}"></script>
@endsection
