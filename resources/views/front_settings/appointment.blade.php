@extends('front_settings.index')
@section('title')
    {{ __('messages.front_settings') }}
@endsection
@section('section')
    <div class="card">
        <div class="card-header">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.front_setting.appointment_details') }}</h3>
            </div>
        </div>
        <div class="card-body text-gray-700">
            {{ Form::open(['route' => ['front.settings.update'], 'method' => 'post', 'files' => true, 'id' => 'createFrontSetting']) }}
            {{ Form::hidden('sectionName', $sectionName) }}
            <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
            <div class="row">
                <!-- About Us title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_title', __('messages.front_setting.about_us_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('appointment_title', $frontSettings['appointment_title'], ['class' => 'form-control form-control-solid', 'required','onkeypress' => 'return avoidSpace(event);']) }}
                </div>
                <!-- About Us description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_description', __('messages.front_setting.about_us_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('appointment_description', $frontSettings['appointment_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5,'onkeypress' => 'return avoidSpace(event);', 'maxlength'=>435]) }}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <!-- Submit Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                    {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-light btn-active-light-primary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

