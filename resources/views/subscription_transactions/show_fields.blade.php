<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">@yield('title')</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a href="{{url()->previous()}}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('user_full_name', __('messages.common.user_details').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $subscription->user->full_name }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('user_email', __('messages.user.email').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $subscription->user->email }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('subscription_plan_name', __('messages.subscription_plans.plan_name').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <div class="d-flex">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ $subscription->subscriptionPlan->name }}</span>&nbsp;&nbsp;
                                    @if($subscription->status == \App\Models\Subscription::ACTIVE)
                                        <span class="badge fs-6 badge-light-success">{{ __('messages.common.active') }}</span>
                                    @else
                                        <span class="badge fs-6 badge-light-danger">{{ __('messages.common.de_active') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('transaction_date', __('messages.subscription_plans.transaction_date').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"
                                      title="{{ date('jS M, Y', strtotime($subscription->created_at)) }}">
                                    {{ date('g:i A jS M, Y', strtotime($subscription->created_at)) }}
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('payment_status', __('messages.subscription_plans.payment_method').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0">
                                    @if($subscription->type == \App\Models\Subscription::TYPE_STRIPE)
                                        <span class="badge fs-6 badge-light-info">{{ \App\Models\Subscription::PAYMENT_TYPES[$subscription->type] }}</span>
                                    @elseif($subscription->type == \App\Models\Subscription::TYPE_PAYPAL)
                                        <span class="badge fs-6 badge-light-primary">{{ \App\Models\Subscription::PAYMENT_TYPES[$subscription->type] }}</span>
                                    @else
                                        {{ __('messages.common.n/a') }}
                                    @endif
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('amount', __('messages.subscription_plans.amount').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ getSubscriptionPlanCurrencyIcon($subscription->subscriptionPlan->currency) }} {{ number_format($subscription->amount) }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"
                                      title="{{ date('jS M, Y', strtotime($subscription->created_at)) }}">{{ $subscription->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"
                                      title="{{ date('jS M, Y', strtotime($subscription->updated_at)) }}">{{ $subscription->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
