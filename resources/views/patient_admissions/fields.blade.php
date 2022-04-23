<div class="row">
    <!-- Patient Id Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('patient_id', __('messages.patient_admission.patient').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('patient_id', $data['patients'], null, ['class' => 'form-select form-select-solid select2Selector','id' => 'patientId', 'placeholder' => 'Select Patient','data-control' => 'select2','required',isset($patientAdmission->patient_admission_id) ? 'disabled' : '']) }}
        @if(isset($patientAdmission->patient_admission_id))
            {{Form::hidden('patient_id',$patientAdmission->patient_admission_id)}}
        @endif
    </div>

    <!-- Doctor Id Field -->
    @if(Auth::user()->hasRole('Doctor'))
        <input type="hidden" name="doctor_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="form-group mb-5 col-sm-6">
            {{ Form::label('doctor_id', __('messages.patient_admission.doctor').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('doctor_id',$data['doctors'], null, ['class' => 'form-select form-select-solid select2Selector','id' => 'doctorId', 'placeholder' => 'Select Doctor','data-control' => 'select2','required']) }}
        </div>
@endif

<!-- Admission Date Field -->
    <div class="form-group mb-5 col-sm-6">
        <input type="hidden" id="patientBirthDate"
               value="{{isset($data['patientAdmissionDate']->patient->user)?$data['patientAdmissionDate']->patient->user->dob:''}}">
        {{ Form::label('admission_date', __('messages.patient_admission.admission_date').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('admission_date', null, ['class' => 'form-control form-control-solid','id' => 'admissionDate','required','autocomplete' => 'off']) }}
    </div>

@isset($patientAdmission)
    <!-- Discharge Date Field -->
        <div class="form-group mb-5 col-sm-6 date-container">
            {{ Form::label('discharge_date', __('messages.patient_admission.discharge_date').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('discharge_date', null, ['class' => 'form-control form-control-solid','id' => 'dischargeDate', 'autocomplete'=>'off']) }}
        </div>
@endisset

<!-- Package Id Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('package_id', __('messages.patient_admission.package').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('package_id', $data['packages'], null, ['class' => 'form-select form-select-solid select2Selector','id' => 'packageId', 'placeholder' => 'Select Package','data-control' => 'select2']) }}
    </div>

    <!-- Insurance Id Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('insurance_id', __('messages.patient_admission.insurance').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('insurance_id', $data['insurances'], null, ['class' => 'form-select form-select-solid select2Selector','id' => 'insuranceId', 'placeholder' => 'Select Insurance','data-control' => 'select2']) }}
    </div>

    <!-- Bed Id Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('bed_id', __('messages.patient_admission.bed').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('bed_id', $data['beds'], null, ['class' => 'form-select form-select-solid select2Selector','id' => 'bedId', 'placeholder' => 'Select Bed','data-control' => 'select2']) }}
    </div>

    <!-- Policy No Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('policy_no', __('messages.patient_admission.policy_no').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('policy_no', null, ['class' => 'form-control form-control-solid']) }}
    </div>

    <!-- Agent Name Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('agent_name', __('messages.patient_admission.agent_name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('agent_name', null, ['class' => 'form-control form-control-solid']) }}
    </div>

    <!-- Guardian Name Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('guardian_name', __('messages.patient_admission.guardian_name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('guardian_name', null, ['class' => 'form-control form-control-solid']) }}
    </div>

    <!-- Guardian Relation Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('guardian_relation', __('messages.patient_admission.guardian_relation').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('guardian_relation', null, ['class' => 'form-control form-control-solid']) }}
    </div>

    <!-- Guardian Contact Field -->
    <div class="form-group mb-5 col-sm-6 mb-5">
        {{ Form::label('guardian_contact', __('messages.patient_admission.guardian_contact').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('guardian_contact', null, ['class' => 'form-control form-control-solid', 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
        {{ Form::hidden('prefix_code', null, ['id' => 'prefix_code']) }}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>

    <!-- Guardian Address Field -->
    <div class="form-group mb-5 col-sm-6">
        {{ Form::label('guardian_address', __('messages.patient_admission.guardian_address').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('guardian_address', null, ['class' => 'form-control form-control-solid']) }}
    </div>

    <!-- Status Field -->
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            <div class="form-check form-check-solid form-switch fv-row">
                <input name="status" class="form-check-input w-35px h-20px is-active" value="1"
                       type="checkbox" {{(isset($patientAdmission) && ($patientAdmission->status)) ? 'checked' : ''}} {{ !isset($patientAdmission) ? 'checked' : '' }}>
            </div>
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12 mb-5 mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id' => 'saveBtn']) }}
        <a href="{{ route('patient-admissions.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
