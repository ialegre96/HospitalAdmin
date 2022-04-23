<div class="col-xl-4 my-4">
    <div class="price-table h-100 pricing-section">
        <div class="price-header">
            <h3 class="price-title">{{ $subscriptionsPricingPlan->name }}</h3>
            <div class="price-value">
                <h2>
                    <span>{{ getSubscriptionPlanCurrencyIcon($subscriptionsPricingPlan->currency) }}</span>{{ number_format($subscriptionsPricingPlan->price) }}
                </h2>
                <span>{{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionsPricingPlan->frequency] }}</span>
            </div>
        </div>
        <div class="price-list">
            <ul class="list-unstyled">
                @php
                    $activeSubscription = getCurrentActiveSubscriptionPlan();
                @endphp
                @if (getLoggedInUser() != null && count($subscriptionsPricingPlan->subscription) > 0)
                    @if($activeSubscription !== null && $activeSubscription->trial_ends_at != null && $activeSubscription->subscription_plan_id == $subscriptionsPricingPlan->id)
                        <li>
                            <h4>{{ __('messages.subscription_plans.valid_until') }}
                                : {{ $subscriptionsPricingPlan->trial_days }}
                            </h4>
                        </li>
                    @endif
                
                    @if($activeSubscription && isAuth() &&  $activeSubscription->subscriptionPlan->id == $subscriptionsPricingPlan->id)
                        <li>
                            <h4>
                                {{ __('messages.subscription_plans.end_date') }}
                                :
                                {{ getParseDate($activeSubscription->ends_at)->format('d-m-Y') }}
                            </h4>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
        @if(count($subscriptionsPricingPlan->planFeatures) > 0)
            <hr/>
            <div class="price-list">
                <ul class="list-unstyled d-inline-block text-start">
                    @foreach($subscriptionsPricingPlan->planFeatures as $planFeature)
                        <li><i class="fas fa-check-double"></i> {{ $planFeature->feature->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @php 
            $currentActiveSubscription = currentActiveSubscription();
        @endphp

        @if($currentActiveSubscription && isAuth() && $subscriptionsPricingPlan->id == $currentActiveSubscription->subscription_plan_id && !$currentActiveSubscription->isExpired())
            @if($subscriptionsPricingPlan->price != 0)
                <button type="button"
                        class="btn btn-success current-active-btn rounded-pill mx-auto d-block pricing-plan-button-active make-cursor-default"
                        data-id="{{ $subscriptionsPricingPlan->id }}">
                    <span>{{ __('messages.subscription_pricing_plans.currently_active') }}</span></button>
            @else
                <button type="button"
                        class="btn btn-info rounded-pill mx-auto d-block renew-free-plan btn-fit-content make-cursor-default">
                    <span>{{ __('messages.subscription_pricing_plans.renew_free_plan') }}</span>
                </button>
            @endif
        @else
            @if($currentActiveSubscription && isAuth() && !$currentActiveSubscription->isExpired() && ($subscriptionsPricingPlan->price == 0 || $subscriptionsPricingPlan->price != 0))
                @if($subscriptionsPricingPlan->hasZeroPlan->count() == 0)
                    <a href="{{ $subscriptionsPricingPlan->price != 0 ? route('choose.payment.type', [$subscriptionsPricingPlan->id, 'landing', $screenFrom]) : 'javascript:void(0)' }}"
                       class="btn btn-primary border border-gray rounded-pill mx-auto d-block btn-fit-content {{ $subscriptionsPricingPlan->price == 0 ? 'freePayment' : ''}}"
                       data-id="{{ $subscriptionsPricingPlan->id }}"
                       data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                        <span>{{ __('messages.subscription_pricing_plans.switch_plan') }}</span></a>
                @else
                    <button type="button"
                            class="btn btn-info rounded-pill mx-auto d-block renew-free-plan btn-fit-content make-cursor-default">
                        <span>{{ __('messages.subscription_pricing_plans.renew_free_plan') }}</span>
                    </button>
                @endif
            @else
                @if($subscriptionsPricingPlan->hasZeroPlan->count() == 0)
                    <a href="{{ $subscriptionsPricingPlan->price != 0 ? route('choose.payment.type', [$subscriptionsPricingPlan->id, 'landing', $screenFrom]) : 'javascript:void(0)' }}"
                       class="btn btn-primary border border-gray rounded-pill mx-auto d-block btn-fit-content {{ $subscriptionsPricingPlan->price == 0 ? 'freePayment' : ''}}"
                       data-id="{{ $subscriptionsPricingPlan->id }}"
                       data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                        <span>{{ __('messages.subscription_pricing_plans.choose_plan') }}</span></a>
                @else
                    <button type="button"
                            class="btn btn-info rounded-pill mx-auto d-block renew-free-plan btn-fit-content make-cursor-default">
                        <span>{{ __('messages.subscription_pricing_plans.renew_free_plan') }}</span>
                    </button>
                @endif
            @endif
        @endif

    </div>
</div>
