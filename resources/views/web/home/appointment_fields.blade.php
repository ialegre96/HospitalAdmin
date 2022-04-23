<?php
$style = 'style=';
$display = 'display:';
?>
<div class="row">
    <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
    <div class="form-group col-md-6 mb-4">
        {{ Form::label('gender', __('messages.patient_appointment').(':')) }}
        <div class="form-check form-check-inline form-check-custom form-check-solid is-valid form-check-sm">
            {{ Form::radio('patient_type', '1', true, ['class' => 'form-check-input new-patient-radio radio_btn']) }}
            <label class="mb-0 label-mt-3">{{ __('messages.new_patient') }}</label>
        </div>
        <div class="form-check form-check-inline">
            {{ Form::radio('patient_type', '2', false, ['class' => 'form-check-input old-patient-radio radio_btn']) }}
            <label class="mb-0 label-mt-3">{{ __('messages.old_patient') }}</label>
        </div>
    </div>
    <div class="form-group col-md-6 patient-email-div mb-4">
        <label>{{__('messages.user.email')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::email('email', null, ['class' => 'form-control form-control-solid old-patient-email','placeholder'=>Lang::get('messages.web_contact.enter_your_email'),'autocomplete' => 'off','required']) }}
    </div>

    <div class="form-group col-sm-6 old-patient d-none mb-4">
        <label for="patient_id">{{__('messages.appointment.patient_name')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::text('patient_name', null, ['class' => 'form-control form-control-solid', 'id' => 'patientName', 'autocomplete' => 'off', 'required', 'readonly']) }}
        {{ Form::hidden('patient_id',null,['id'=>'patient']) }}
    </div>
    <div class="form-group col-xl-3 col-md-6 first-name-div mb-4">
        <label for="first_name">{{__('messages.user.first_name')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::text('first_name', null, ['class' => 'form-control form-control-solid','placeholder'=>Lang::get('messages.web_appointment.enter_your_first_name'),'autocomplete' => 'off','required','id'=>'firstName']) }}
    </div>
    <div class="form-group col-xl-3 col-md-6 last-name-div mb-4">
        <label for="last_name">{{__('messages.user.last_name')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::text('last_name', null, ['class' => 'form-control form-control-solid','placeholder'=>Lang::get('messages.web_appointment.enter_your_last_name'),'autocomplete' => 'off','required','id'=>'lastName']) }}
    </div>
    <div class="form-group col-md-6 gender-div mb-4">
        <label for="gender">{{__('messages.user.gender')}}:
            <span class="text text-danger">*</span>
        </label>
        <div class="form-check form-check-inline">
            {{ Form::radio('gender', '0', true, ['class' => 'form-check-input radio_btn', 'id' => 'flexRadioSm']) }}
            <label class="mb-0 label-mt-3">{{ __('messages.user.male') }}</label>
        </div>
        <div class="form-check form-check-inline">
            {{ Form::radio('gender', '1', false, ['class' => 'form-check-input radio_btn', 'id' => 'flexRadioSm']) }}
            <label class="mb-0 label-mt-3">{{ __('messages.user.female') }}</label>
        </div>
    </div>
    <div class="form-group col-xl-3 col-md-6 password-div mb-4">
        <label for="password">{{__('messages.user.password')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::password('password', ['class' => 'form-control form-control-solid','placeholder'=>Lang::get('messages.web_appointment.enter_your_password'),'required','min' => '6','max' => '10','id'=>'password']) }}
    </div>
    <div class="form-group col-xl-3 col-md-6 confirm-password-div mb-4">
        <label for="password_confirmation">{{__('messages.user.password_confirmation')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::password('password_confirmation', ['class' => 'form-control form-control-solid','placeholder'=>Lang::get('messages.web_appointment.enter_confirm_password'),'required','min' => '6','max' => '10','id'=>'confirmPassword']) }}
    </div>
    <div class="form-group drop_down col-sm-6 mb-4">
        <label for="department_id">{{__('messages.appointment.doctor_department')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::select('department_id',$departments, null, ['class' => 'selectized', 'id' => 'departmentId', 'placeholder'=>Lang::get('messages.web_appointment.select_department'), 'required']) }}
    </div>

    <input type="hidden" id="doctor" value="{{$data['doctorId']}}">
    <input type="hidden" id="appointmentDate" value="{{$data['appointmentDate']}}">

    <div class="form-group drop_down col-sm-6 mb-4">
        <label for="doctor_id">{{__('messages.appointment.doctor')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::select('doctor_id',[], null, ['class' => 'selectized', 'autocomplete' => 'off', 'id' => 'doctorId', 'placeholder'=>Lang::get('messages.web_appointment.select_doctor'), 'required']) }}
    </div>
    <div class="form-group col-md-6 mb-4">
        <label for="opd_date">{{__('messages.investigation_report.date')}}:
            <span class="text text-danger">*</span>
        </label>
        {{ Form::text('opd_date', null, ['class' => 'form-control form-control-solid', 'autocomplete' => 'off', 'id' => 'opdDate','required']) }}
    </div>

    <div class="form-group col-sm-12">
        <label for="problem">{{__('messages.appointment.description')}}:</label>
        {{ Form::textarea('problem', null, ['class' => 'form-control form-control-solid','placeholder'=>Lang::get('messages.web_appointment.enter_description'),'autocomplete' => 'off', 'rows' => 3]) }}
    </div>

    <div align="left" class="form-group col-sm-12">
        <div class="doctor-schedule" {{$style}}"{{$display}} none;">
        <i class="fas fa-calendar-alt"></i>
        <span class="day-name"></span>
        <span class="schedule-time"></span>
    </div>
    <strong class="error-message" {{$style}}"{{$display}} none;"></strong>
    <div class="slot-heading mb-4">
        <strong class="available-slot-heading"
        {{$style}}"{{$display}} none;">{{ __('messages.available_slots') }}:</strong>
    </div>
    <div class="row">
        <div class="available-slot form-group col-sm-10">
        </div>
    </div>
    <div class="color-information d-none" align="right" {{$style}}"{{$display}} none;">
    <span><i class="fa fa-circle fa-xs" aria-hidden="true"> </i> {{ __('messages.bed.not_available') }}</span>
</div>
</div>
<?php
$userName = request()->segment(2);
$isEnabledGoogleCapcha = getSettingForReCaptcha($userName);
?>
@if($isEnabledGoogleCapcha == true)
    <div class="form-group col-xl-12">
        @if(config('app.recaptcha.key'))
            <div class="g-recaptcha" data-sitekey="{{config('app.recaptcha.key')}}">
            </div>
        @endif
    </div>
@endif
<div class="form-group col-sm-1 pl-3">
    <button type="submit" class="default-btn"
            id="btnSave">{{__('messages.common.save')}}</button>
    </div>
    </div>
