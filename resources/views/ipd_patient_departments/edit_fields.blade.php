<div class="row gx-10 mb-5">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('patient_id',__('messages.ipd_patient.patient_id').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('patient_id', $data['patients'], null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'patientId', 'placeholder' => 'Select Patient', 'data-control' => 'select2']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('case_id', __('messages.ipd_patient.case_id').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('case_id', [null], null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'caseId', 'disabled', 'data-control' => 'select2', 'placeholder' => 'Choose Case']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('ipd_number', __('messages.ipd_patient.ipd_number').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('ipd_number', null, ['class' => 'form-control form-control-solid', 'readonly']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('height', __('messages.ipd_patient.height').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::number('height', null, ['class' => 'form-control floatNumber form-control-solid', 'max' => '7', 'step' => '.01']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('weight', __('messages.ipd_patient.weight').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::number('weight', null, ['class' => 'form-control floatNumber form-control-solid', 'data-mask'=>'##0,00', 'max' => '200', 'step' => '.01', 'tabindex' => '3']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('bp', __('messages.ipd_patient.bp').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('bp', null, ['class' => 'form-control form-control-solid', 'tabindex' => '4']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('admission_date', __('messages.ipd_patient.admission_date').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::text('admission_date', null, ['class' => 'form-control form-control-solid','id' => 'admissionDate','autocomplete' => 'off', 'required', 'tabindex' => '5']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('doctor_id',__('messages.ipd_patient.doctor_id').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('doctor_id', $data['doctors'], null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'doctorId', 'placeholder' => 'Select Doctor', 'data-control' => 'select2', 'tabindex' => '6']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('bed_type_id',__('messages.ipd_patient.bed_type_id').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('bed_type_id', $data['bedTypes'], null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'bedTypeId', 'placeholder' => 'Select Bed Type', 'data-control' => 'select2', 'tabindex' => '7']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('bed_id',__('messages.ipd_patient.bed_id').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('bed_id', [null], null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'bedId', 'disabled', 'data-control' => 'select2', 'placeholder' => 'Bed Id']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('is_old_patient',__('messages.ipd_patient.is_old_patient').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <div class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input w-35px h-20px" name="is_old_patient" type="checkbox" value="1"
                           id="flexSwitchDefault" {{ ($ipdPatientDepartment->is_old_patient) ? 'checked' : '' }}>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('symptoms',__('messages.ipd_patient.symptoms').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::textarea('symptoms', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('notes',__('messages.ipd_patient.notes').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::textarea('notes', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
            </div>
        </div>
    </div>
</div>
<div class=" d-flex">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnIpdPatientEdit']) }}
    <a href="{{ route('ipd.patient.index') }}"
       class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
