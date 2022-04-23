@extends('layouts.app')
@section('title')
    {{__('messages.subscription_plans.payment_type')}}
@endsection
@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header ms-auto border-0">
            <div class="d-flex align-items-center py-0">
                <a href="{{url()->previous()}}"
                   class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        <div class="card-body p-lg-10">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <h1 class="text-center">{{__('messages.subscription_plans.payment_type')}}</h1>
                </div>
                @if(!currentActiveSubscription()->isExpired())
                    @php
                        $planData = getProratedPlanData($subscriptionsPricingPlan->id);
                    @endphp
                    <div class="col-xl-6 m-auto">
                        <div class="card card-bordered mb-4 mt-7">
                            <div class="card-header ribbon ribbon-end position-relative">
                                <div class="card-title">{{ __('messages.subscription_plans.remaining_balance') }}</div>
                                <div class="ribbon-label bg-primary fs-4">{{ $planData['remainingBalance'] }}</div>
                            </div>
                        </div>
                        <div class="card card-bordered mb-4">
                            <div class="card-header ribbon ribbon-end position-relative">
                                <div class="card-title">{{ __('messages.subscription_plans.amount_to_pay') }}</div>
                                <div class="ribbon-label bg-info fs-4">{{ $planData['amountToPay'] }}</div>
                            </div>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-header ribbon ribbon-end position-relative">
                                <div class="card-title">{{ __('messages.subscription_plans.used_days') }}</div>
                                <div class="ribbon-label bg-success fs-4">{{ $planData['usedDays'] }}</div>
                            </div>
                        </div>
                        @if ( $planData['totalDays'] > 0)
                            {{--        EXTRA DAYS WHEN REMAING BALANCE > PLAN AMOUNT         --}}
                            <div class="card card-bordered mb-4 mt-7">
                                <div class="card-header ribbon ribbon-end position-relative">
                                    <div class="card-title">{{ __('messages.subscription_plans.total_extra_days') }}</div>
                                    <div class="ribbon-label bg-primary fs-4">{{ $planData['totalDays'] }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="{{ currentActiveSubscription()->isExpired() ? 'col-xl-4 my-4' : 'col-xl-6' }}">
                    <div class="d-flex mt-7 align-items-center">
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <div class="text-center">
                                <h1 class="text-dark mb-5 fw-boldest">{{ $subscriptionsPricingPlan->name }}</h1>
                                <div class="text-center">
                                    <span class="mb-2 text-primary">{{ getSubscriptionPlanCurrencyIcon($subscriptionsPricingPlan->currency) }}</span>
                                    <span class="fs-3x fw-bolder text-primary" data-kt-plan-price-month="39"
                                          data-kt-plan-price-annual="399">{{ number_format($subscriptionsPricingPlan->price) }}</span>
                                    <span class="fs-7 fw-bold opacity-50">/{{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionsPricingPlan->frequency] }}</span>
                                </div>
                                <div class="mt-2 border border-gray-400 {{ $planData['totalDays'] > 0 ? 'd-none' : '' }}">
                                    {{ Form::select('payment_type', $paymentTypes, \App\Models\Subscription::TYPE_STRIPE, ['class' => 'form-select form-select-solid','required', 'id' => 'paymentType', 'data-control' => 'select2']) }}
                                </div>
                                <div class="mt-5 stripePayment proceed-to-payment">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block makePayment"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                        {{ __('messages.subscription_pricing_plans.proceed_to_payment') }}</button>
                                </div>
                                <div class="mt-5 paypalPayment proceed-to-payment d-none">
                                    <button type="button"
                                            class="btn btn-primary rounded-pill mx-auto d-block paymentByPaypal"
                                            data-id="{{ $subscriptionsPricingPlan->id }}"
                                            data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                        {{ __('messages.subscription_pricing_plans.proceed_to_payment') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let makePaymentURL = "{{ route('purchase-subscription') }}";
        let subscribeText = "{{ __('messages.subscription_pricing_plans.choose_plan') }}";
        let stripe = Stripe('{{ config('services.stripe.key') }}');
        let subscriptionPlans = "{{ route('subscription.pricing.plans.index') }}";
    </script>
    <script src="{{ mix('assets/js/subscriptions/subscription.js') }}"></script>
@endsection
