<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">@yield('title')</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a href="{{route('super.admin.subscription.plans.edit', $subscriptionPlan->id)}}"
                           class="btn btn-sm btn-primary me-2">{{ __('messages.common.edit') }}</a>
                        <a href="{{route('super.admin.subscription.plans.index')}}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('name', __('messages.subscription_plans.name').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $subscriptionPlan->name }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('currency', __('messages.subscription_plans.currency').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ strtoupper($subscriptionPlan->currency) }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('price', __('messages.subscription_plans.price').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">
                                    {{ getSubscriptionPlanCurrencyIcon($subscriptionPlan->currency) }} {{ number_format($subscriptionPlan->price) }}
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('plan_type', __('messages.subscription_plans.plan_type').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0">
                                    @if($subscriptionPlan->frequency == \App\Models\SubscriptionPlan::MONTH)
                                        <span class="badge fs-6 badge-light-info">{{ \App\Models\SubscriptionPLAN::PLAN_TYPE[$subscriptionPlan->frequency] }}</span>
                                    @elseif($subscriptionPlan->frequency == \App\Models\SubscriptionPlan::YEAR)
                                        <span class="badge fs-6 badge-light-primary">{{ \App\Models\SubscriptionPLAN::PLAN_TYPE[$subscriptionPlan->frequency] }}</span>
                                    @else
                                        {{ __('messages.common.n/a') }}
                                    @endif
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('valid_until', __('messages.subscription_plans.valid_until').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">
                                    {{ $subscriptionPlan->trial_days != 0 ? $subscriptionPlan->trial_days : __('messages.common.n/a') }}
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('active_plan', __('messages.subscription_plans.active_plan').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">
                                    {{ $subscriptionPlan->subscription->count() }}
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"
                                      title="{{ date('jS M, Y', strtotime($subscriptionPlan->created_at)) }}">{{ $subscriptionPlan->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"
                                      title="{{ date('jS M, Y', strtotime($subscriptionPlan->updated_at)) }}">{{ $subscriptionPlan->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        @if($subscriptionPlan->features->count() > 0)
                            <div class="separator my-5"></div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <h4 class="mt-2">{{ __('messages.subscription_plans.plan_features') }}</h4>
                                </div>
                            </div>

                            <div class="separator my-5"></div>

                            <div class="row">
                                @foreach($subscriptionPlan->features as $planFeature)
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-5">
                                        <div class="d-flex">
                                            <i class='fas fa-bullseye mt-1'></i> &nbsp;<h6>{{ $planFeature->name }}</h6>&nbsp;&nbsp;
                                            @if($planFeature->submenu != 0)
                                                <i class="fas fa-question-circle mt-1 general-question-mark trial-tooltip"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="{{ __('messages.subscription_plans.default_plan_text_one') }}
                                                   {{ $planFeature->submenu }} {{ __('messages.subscription_plans.default_plan_text_two') }}"></i>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
