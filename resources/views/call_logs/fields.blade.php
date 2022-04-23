<div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Name',__('messages.call_log.name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <span
            class="text-danger">*</span>
        {{ Form::text('name', null, ['class' => 'form-control form-control-solid','required']) }}
    </div>
    <div class="form-group col-sm-6 myclass mb-5">
        {{ Form::label('Phone',__('messages.call_log.phone').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {!! Form::tel('phone', null, ['class' => 'form-control form-control-solid','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) !!}
        {!! Form::hidden('prefix_code',null,['id'=>'prefix_code']) !!}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Date',__('messages.call_log.received_on').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('date', null, ['class' => 'form-control form-control-solid','autocomplete' => 'off','id' => 'date']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Follow-Up Date',__('messages.call_log.follow_up_date').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('follow_up_date', null, ['class' => 'form-control form-control-solid','autocomplete' => 'off','id' => 'followUpDate']) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Note',__('messages.call_log.note').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::textarea('note', null, ['class' => 'form-control form-control-solid','rows' => 5,'cols' => 5]) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Call Type',__('messages.call_log.call_type').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                <label
                    class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.call_log.incoming') }}</label>&nbsp;&nbsp;
            {{ Form::radio('call_type',\App\Models\CallLog::INCOMING, true,['class' => 'form-check-input']) }}
         <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.call_log.outgoing') }}</label>
            {{ Form::radio('call_type',\App\Models\CallLog::OUTCOMING, false,['class' => 'form-check-input']) }}
        </span>
    </div>
</div>
<div class="d-flex mt-5">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) !!}
    <a href="{!! route('call_logs.index') !!}"
       class="btn btn-light btn-active-light-primary me-2">{!! __('messages.common.cancel') !!}</a>
</div>

