<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('patient_name', __('messages.case.patient').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select form-select-solid select2Selector', 'required', 'id' => 'patientId', 'placeholder' => 'Select Patient', 'data-control' => 'select2', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('doctor_name', __('messages.case.doctor').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select form-select-solid select2Selector', 'required', 'id' => 'doctorId', 'placeholder' => 'Select Doctor', 'data-control' => 'select2', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('date', __('messages.case.case_date').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('date', null, ['id'=>'date','class' => 'form-control form-control-solid','required', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group col-md-6 mb-5">
        {{ Form::label('phone', __('messages.case.phone').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <br>
        {!! Form::tel('phone', null, ['class' => 'form-control form-control-solid', 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5']) !!}
        <br>
        {!! Form::hidden('prefix_code',null,['id'=>'prefix_code']) !!}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="form-group col-md-6 mb-5">
        {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <br>
        <div class="form-check form-check-solid form-switch fv-row">
            <input name="status" class="form-check-input w-35px h-20px is-active" value="1"
                   type="checkbox" {{(!isset($patientCase))? 'checked': (($patientCase->status) ? 'checked' : '')}}>
        </div>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('fee', __('messages.case.fee').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('fee', null, ['class' => 'form-control form-control-solid price-input price','required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
    </div>
    <div class="form-group col-sm-12 mb-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id' => 'saveBtn']) }}
        <a href="{{ route('patient-cases.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
