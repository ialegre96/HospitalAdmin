<div class="row">
    {{-- Subscription Plan section starts --}}
    <div class="col-md-4 mb-5">
        <div class="form-group">
            {{ Form::label('name', __('messages.subscription_plans.name').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('name', null , ['class' => 'form-control form-control-solid','required','placeholder' => __('Entry Plan Name'),'id'=>'name']) }}
        </div>
    </div>
    <div class="col-md-4 mb-5 hide_for_trail">
        <div class="form-group">
            {{ Form::label('currency', __('messages.subscription_plans.currency').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 for_trail_label required']) }}
            {{ Form::select('currency', getCurrencyFullName(), null,['class' => 'form-select form-select-solid for_trail_required','data-control' =>'select2','id'=>'currency','placeholder'=>'Select Currency', 'required']) }}
        </div>
    </div>
    <div class="col-md-4 mb-5 hide_for_trail">
        <div class="form-group">
            {{ Form::label('price', __('messages.subscription_plans.price').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 for_trail_label required']) }}
            {{ Form::text('price', null , ['class' => 'form-control form-control-solid price-input price for_trail_required','placeholder' => 'Enter price', 'id'=>'price','maxlength' => '4', 'required']) }}
        </div>
    </div>
    <div class="col-md-4 mb-5 hide_for_trail">
        <div class="form-group">
            {{ Form::label('frequency', __('messages.subscription_plans.plan_type').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 for_trail_label required']) }}
            {{ Form::select('frequency', $planType, null, ['required', 'id' => 'planType','class' => 'form-select form-select-solid for_trail_required','data-control' =>'select2', 'required']) }}
        </div>
    </div>
    <div class="col-md-4 mb-5 hide_for_trail">
        <div class="form-group">
            {{ Form::label('trial_days', __('messages.subscription_plans.trail_plan').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 for_trail_label']) }}
            {{ Form::text('trial_days', null , ['class' => 'form-control form-control-solid price-input price for_trail_required','placeholder' => 'Enter Trial Days', 'id'=>'trialDays','maxlength' => '3']) }}
        </div>
    </div>
    {{-- Subscription Plan section ends --}}

    {{-- Subscription Plan Features starts here --}}
    @include('super_admin.subscription_plans.plan_features')
    {{-- Subscription Plan Features ends here --}}

    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnSave']) }}
        <a href="{{ route('super.admin.subscription.plans.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
