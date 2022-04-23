<div class="row gx-10 mb-5">
    <div class="form-group col-md-3 mb-5">
        {{ Form::label('patient_id', __('messages.prescription.patient').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('patient_id',$patients, null, ['class' => 'form-select form-select-solid','required','id' => 'patient_id','placeholder'=>'Select Patient']) }}
    </div>
    @if(Auth::user()->hasRole('Doctor'))
        <input type="hidden" name="doctor_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="form-group col-md-3 mb-5">
            {{ Form::label('doctor_name', __('messages.case.doctor').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('doctor_id',$doctors, null, ['class' => 'form-select form-select-solid','required','id' => 'doctorId','placeholder'=>'Select Doctor']) }}
        </div>
    @endif
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('food_allergies', __('messages.prescription.food_allergies').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('food_allergies', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('tendency_bleed', __('messages.prescription.tendency_bleed').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('tendency_bleed', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('heart_disease', __('messages.prescription.heart_disease').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('heart_disease', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('high_blood_pressure', __('messages.prescription.high_blood_pressure').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('high_blood_pressure', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('diabetic', __('messages.prescription.diabetic').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('diabetic', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('surgery', __('messages.prescription.surgery').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('surgery', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('accident', __('messages.prescription.accident').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('accident', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('others', __('messages.prescription.others').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('others', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('medical_history', __('messages.prescription.medical_history').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('medical_history', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('current_medication', __('messages.prescription.current_medication').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('current_medication', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('female_pregnancy', __('messages.prescription.female_pregnancy').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('female_pregnancy', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('breast_feeding', __('messages.prescription.breast_feeding').(':'), ['class' => 'form-labelfs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('breast_feeding', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('health_insurance', __('messages.prescription.health_insurance').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('health_insurance', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('low_income', __('messages.prescription.low_income').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('low_income', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('reference', __('messages.prescription.reference').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('reference', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            <div class="form-check form-check-solid form-switch fv-row">
                <input name="status" class="form-check-input w-35px h-20px is-active" value="1"
                       type="checkbox" {{(isset($prescription) && ($prescription->status)) ? 'checked' : ''}}>
                <label class="form-check-label" for="allowmarketing"></label>
            </div>
        </div>
    </div>
</div>
<div class=" d-flex">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'btnSave']) !!}
    <a href="{!! route('prescriptions.index') !!}"
       class="btn btn-light btn-active-light-primary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
