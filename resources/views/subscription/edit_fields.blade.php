<div class="row gx-10 mb-5">
    <div class="form-group col-md-3 mb-5">
        {{ Form::label('user_full_name', __('messages.hospitals_list.hospital_name').(':'), ['class' => 'fw-bold text-muted py-3']) }}
        <br>
        <span class="fw-bolder fs-6 text-gray-800">{{ $subscription->user->full_name }}</span>
    </div>
    <div class="form-group col-md-3 mb-5">
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
    <div class="form-group col-md-3 mb-5">
        {{ Form::label('payment_status', __('messages.subscription_plans.frequency').(':'), ['class' => 'fw-bold text-muted py-3']) }}
        <p class="m-0">
            @if($subscription->plan_frequency == 1)
                <span class="badge fs-6 badge-light-info">{{ \App\Models\Subscription::MONTH }}</span>
            @elseif($subscription->plan_frequency == 2)
                <span class="badge fs-6 badge-light-primary">{{ \App\Models\Subscription::YEAR   }}</span>
            @else
                {{ __('messages.common.n/a') }}
            @endif
        </p>
    </div>
    <div class="form-group col-md-3 mb-5">
        {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        <div>
            @if($subscription->status == \App\Models\Subscription::ACTIVE)
                <span class="badge fs-6 badge-light-success">{{ __('messages.common.active') }}</span>
            @else
                <span class="badge fs-6 badge-light-danger">{{ __('messages.common.de_active') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('starts_at', __('messages.subscription_plans.start_date').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            <span class="fw-bolder fs-6 text-gray-800"
                  title="{{ date('jS M, Y', strtotime($subscription->starts_at)) }}">
                {{ date('g:i A jS M, Y', strtotime($subscription->starts_at)) }}
            </span>
        </div>
    </div>
    <div class="col-md-3">
        @if(!empty($subscription->transactions->payment_type) && $subscription->transactions->payment_type == \App\Models\Transaction::TYPE_CASH)
            @if($subscription->transactions->status == 0 && ($subscription->transactions->is_manual_payment == 0 || $subscription->transactions->is_manual_payment == 2))
                {{ Form::label('ends_at', __('messages.subscription_plans.end_date').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <br>
                <span class="fw-bolder fs-6 text-gray-800"
                      title="{{ date('jS M, Y', strtotime($subscription->ends_at)) }}">
                    {{ date('g:i A jS M, Y', strtotime($subscription->ends_at)) }}
                </span>
            @else
                <div class="form-group mb-5">
                    {{ Form::label('ends_at', __('messages.subscription_plans.end_date').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('ends_at', null, ['class' => 'form-control form-control-solid', 'id' => 'endsAt']) }}
                </div>
            @endif
        @else
            <div class="form-group mb-5">
                {{ Form::label('ends_at', __('messages.subscription_plans.end_date').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('ends_at', null, ['class' => 'form-control form-control-solid', 'id' => 'endsAt']) }}
            </div>
        @endif
    </div>
</div>
<div class=" d-flex">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'btnSave']) !!}
    <a href="{!! route('subscriptions.list.index') !!}"
       class="btn btn-light btn-active-light-primary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
