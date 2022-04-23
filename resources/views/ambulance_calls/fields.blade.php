<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('patient_id', __('messages.ambulance_call.patient').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select form-select-solid','required','id' => 'patientId','placeholder'=>'Select Patient','data-control' => 'select2']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('ambulance_id', __('messages.ambulance_call.vehicle_model').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('ambulance_id', $ambulances, null, ['class' => 'form-select form-select-solid','required','id' => 'ambulanceId','placeholder'=>'Select Ambulance','data-control' => 'select2']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('date', __('messages.ambulance_call.date').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('date', null, ['id'=>'date', 'class' => 'form-control form-control-solid', 'required','autocomplete' => 'off']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('driver_name', __('messages.ambulance_call.driver_name').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('driver_name', null, ['class' => 'form-control form-control-solid', 'required', 'readonly', 'id' => 'driverName']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('amount', __('messages.ambulance_call.amount').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('amount', null, ['class' => 'form-control price-input form-control-solid', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
    </div>
    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'saveBtn']) }}
        <a href="{{ route('ambulance-calls.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
