@extends('front_settings.index')
@section('title')
    {{ __('messages.front_settings') }}
@endsection
@section('section')
    <div class="card">
        <div class="card-header">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.front_setting.terms_condition_details') }}</h3>
            </div>
        </div>
        <div class="card-body text-gray-700">
            {{ Form::open(['route' => ['front.settings.update'], 'method' => 'post', 'files' => true, 'id' => 'termsAndCondition']) }}
            {{ Form::hidden('sectionName', $sectionName) }}
            <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
            <div class="row mt-3 mb-5">
                <!-- Term condition Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('term_condition', __('messages.front_setting.terms_conditions').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <div id="termConditionId" class="editor-height"></div>
                    {{ Form::hidden('terms_conditions', null, ['id' => 'termData']) }}
                </div>

                <!-- Privacy policy Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('privacy_policy', __('messages.front_setting.privacy_policy').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <div id="privacyPolicyId" class="editor-height"></div>
                    {{ Form::hidden('privacy_policy', null, ['id' => 'privacyData']) }}
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
@section('scripts')
    <script>
        let termConditionData = `{{$frontSettings['terms_conditions']}}`;
        let privacyPolicyData = `{{$frontSettings['privacy_policy']}}`;
        let termConditionPrivacyPolicy = true;
    </script>
    <script src="{{mix('assets/js/front_settings/cms/create-edit.js')}}"></script>
@endsection
