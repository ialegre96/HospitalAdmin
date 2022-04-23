<div class="row gx-10 mb-5">
    <div class="col-sm-6 mb-5">
        {{ Form::label('account_id', __('messages.payment.account').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('account_id', $accounts, null, ['class' => 'form-select form-select-solid fw-bold','required','id' => 'accountId','placeholder'=>'Select Account','data-control' => 'select2']) }}
    </div>
    <div class="col-sm-6 mb-5">
        {{ Form::label('payment_date', __('messages.payment.payment_date').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('payment_date', null, ['id'=>'paymentDate', 'class' => 'form-control form-control-solid', 'required','autocomplete' => 'off']) }}
    </div>
    <div class="col-sm-6 mb-5">
        {{ Form::label('pay_to', __('messages.payment.pay_to').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('pay_to', null, ['class' => 'form-control form-control-solid', 'required']) }}
    </div>
    <div class="col-sm-6 mb-5">
        {{ Form::label('amount', __('messages.payment.amount').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('amount', null, ['class' => 'form-control price-input price form-control-solid', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
    </div>
    <div class="col-sm-6 mb-5">
        {{ Form::label('description', __('messages.payment.description').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
    </div>
</div>
<div class="d-flex">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) !!}
    <a href="{!! route('payments.index') !!}"
       class="btn btn-light btn-active-light-primary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
