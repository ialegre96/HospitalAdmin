<?php
$style = 'style=';
$display = 'display:';
?>
<div class="row">
    <!-- Patient Name Field -->
    @if(Auth::user()->hasRole('Patient'))
        <input type="hidden" name="patient_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('patient_name', __('messages.case.patient').':', ['class' => 'form-label fs-6 required fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('patient_id', $patients, null, ['class' => 'form-select form-select-solid','required','id' => 'patientId','placeholder'=>'Select Patient', 'data-control' => 'select2']) }}
        </div>
    @endif
<!-- Department Name Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('department_name', __('messages.appointment.doctor_department').':', ['class' => 'form-label fs-6 required fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('department_id',$departments, null, ['class' => 'form-select form-select-solid','required','id' => 'departmentId','placeholder'=>'Select Department', 'data-control' => 'select2']) }}
    </div>
    <!-- Doctor Name Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('doctor_name', __('messages.case.doctor').':', ['class' => 'form-label fs-6 required fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('doctor_id',(isset($doctors) ? $doctors : []), null, ['class' => 'form-select form-select-solid','required','id' => 'doctorId','placeholder'=>'Select Doctor', 'data-control' => 'select2']) }}
    </div>

    @if(!Auth::user()->hasRole('Patient'))
    <!-- Date Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('opd_date', __('messages.appointment.date').':', ['class' => 'form-label fs-6 required fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('opd_date', isset($appointment) ? $appointment->opd_date->format('Y-m-d') : null, ['id'=>'opdDate', 'class' => 'form-control form-control-solid', 'required', 'autocomplete'=>'off']) }}
        </div>
        <!-- Notes Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('problem', __('messages.appointment.description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('problem', null, ['class' => 'form-control form-control-solid', 'rows'=>'4']) }}
        </div>
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input w-35px h-20px" name="status" type="checkbox"
                       value="1" checked>
            </div>
        </div>
        <div class="form-group col-sm-6 mb-5">
            <div class="doctor-schedule" {{$style}}"{{$display}} none">
            <i class="fas fa-calendar-alt"></i>
            <span class="day-name"></span>
            <span class="schedule-time"></span>
        </div>
        <strong class="error-message" {{$style}}"{{$display}} none"></strong>
        <div class="slot-heading">
            <strong class="available-slot-heading"
            {{$style}}"{{$display}} none">{{ __('messages.appointment.available_slot').':' }}</strong>
        </div>
        <div class="row">
            <div class="available-slot form-group col-sm-12">
            </div>
        </div>
        <div align="right" {{$style}}"{{$display}} none">
        <span><i class="fa fa-circle fa-xs color-information" aria-hidden="true"> </i> {{ __('messages.appointment.no_available') }}</span>
</div>
</div>
@endif

@if(Auth::user()->hasRole('Patient'))
    <!-- Date Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('opd_date', __('messages.appointment.date').':', ['class' => 'form-label fs-6 required fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('opd_date', null, ['id'=>'opdDate', 'class' => 'form-control form-control-solid', 'required', 'autocomplete'=>'off']) }}
    </div>

    <!-- Notes Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('problem', __('messages.appointment.description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::textarea('problem', null, ['class' => 'form-control form-control-solid', 'rows'=>'4']) }}
    </div>
    <div class="form-group col-sm-6 available-slot-div">
        <div class="doctor-schedule" {{$style}}"{{$display}} none">
        <i class="fas fa-calendar-alt"></i>
        <span class="day-name"></span>
        <span class="schedule-time"></span>
    </div>
    <strong class="error-message" {{$style}}"{{$display}} none"></strong>
    <div class="slot-heading">
        <strong class="available-slot-heading" {{$style}}"{{$display}}
        none">{{ __('messages.appointment.available_slot').':' }}</strong>
    </div>
    <div class="row">
        <div class="available-slot form-group col-sm-10"></div>
    </div>
    </div>
    @endif
    </div>

    <div class="row">
        <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id'=>'saveBtn']) }}
        <a href="{{ route('appointments.index') }}" class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
