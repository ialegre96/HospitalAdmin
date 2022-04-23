{{ Form::hidden('revisit', (isset($data['last_visit'])) ? $data['last_visit']->id : null) }}
<div class="row gx-10 mb-5">
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('patient_id',__('messages.ipd_patient.patient_id').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('patient_id', $data['patients'], (isset($data['last_visit'])) ? $data['last_visit']->patient_id : null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'patientId', 'placeholder' => 'Select Patient', 'data-control' => 'select2']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('case_id', __('messages.ipd_patient.case_id').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('case_id', [null], null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'caseId', 'disabled', 'data-control' => 'select2', 'placeholder' => 'Choose Case']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('opd_number', __('messages.opd_patient.opd_number').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('opd_number', $data['opdNumber'], ['class' => 'form-control form-control-solid', 'readonly']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('height', __('messages.ipd_patient.height').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::number('height', (isset($data['last_visit'])) ? $data['last_visit']->height : 0, ['class' => 'form-control form-control-solid', 'max' => '7', 'step' => '.01']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('weight', __('messages.ipd_patient.weight').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::number('weight', (isset($data['last_visit'])) ? $data['last_visit']->weight : 0, ['class' => 'form-control form-control-solid', 'max' => '200', 'step' => '.01']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('bp', __('messages.ipd_patient.bp').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('bp', (isset($data['last_visit'])) ? $data['last_visit']->bp : null, ['class' => 'form-control form-control-solid']) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('appointment_date', __('messages.opd_patient.appointment_date').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::text('appointment_date', null, ['class' => 'form-control form-control-solid','id' => 'appointmentDate','autocomplete' => 'off', 'required']) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('doctor_id',__('messages.ipd_patient.doctor_id').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('doctor_id', $data['doctors'], (isset($data['last_visit'])) ? $data['last_visit']->doctor_id : null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'doctorId', 'placeholder' => 'Select Doctor', 'data-control' => 'select2']) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                <div class="form-group">
                    {{ Form::label('standard_charge', __('messages.doctor_opd_charge.standard_charge').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <span class="text-danger">*</span>
                    <div class="input-group">
                        {{ Form::text('standard_charge', null , ['class' => 'form-control form-control-solid price-input', 'id' => 'standardCharge', 'required']) }}
                        <div class="input-group-text border-0"><a><i class="{{ getCurrenciesClass() }}"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('payment_mode', __('messages.ipd_payments.payment_mode').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('payment_mode', $data['paymentMode'], null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'paymentMode', 'data-control' => 'select2', 'placeholder' => 'Choose Payment']) }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('symptoms',__('messages.ipd_patient.symptoms').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::textarea('symptoms', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('notes',__('messages.ipd_patient.notes').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::textarea('notes', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('is_old_patient', __('messages.ipd_patient.is_old_patient').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}<br>
                <div class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input w-35px h-20px" name="is_old_patient" type="checkbox" value="1">
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" d-flex">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) }}
    <a href=" {{ route('opd.patient.index') }}"
       class="btn btn-light btn-active-light-primary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
