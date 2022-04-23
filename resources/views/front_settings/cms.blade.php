@extends('front_settings.index')
@section('title')
    {{ __('messages.front_settings') }}
@endsection
@section('section')
    <div class="card">
        <div class="card-header">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.front_setting.front_setting_details') }}</h3>
            </div>
        </div>
        <div class="card-body text-gray-700">
            {{ Form::open(['route' => ['front.settings.update'], 'method' => 'post', 'files' => true, 'id' => 'addCMSForm']) }}
            {{ Form::hidden('sectionName', $sectionName) }}
            <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
            <div class="row">
                <!-- Home Image Field -->
                <div class="form-group col-sm-6 mb-5">
                    <div class="row2">
                        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                               for="about_us_image"> <span>{{__('messages.front_setting.home_page_image')}}: </span>
                            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                               title="Best resolution for this profile will be 735x850"></i>
                        </label>
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <?php
                            $style = 'style=';
                            $background = 'background-image:';
                            ?>
                            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                            {{$style}}"{{$background}}
                            url({{ ($frontSettings['home_page_image']) ? $frontSettings['home_page_image'] : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
                            )">
                        </div>
                        <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Change image">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            {{ Form::file('home_page_image',['id'=>'homePageImage','class' => 'd-none','accept' => '.png, .jpg, .jpeg']) }}
                            <input type="hidden" name="avatar_remove">
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                  data-bs-original-title="Cancel image">
                                    <i class="bi bi-x fs-2"></i></span>
                        </div>
                    </div>
                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                </div>

            <!-- Certified Doctor Image Field -->
            <div class="form-group col-sm-6 mb-5">
                <div class="row2">
                    <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                           for="about_us_image"> <span>{{__('messages.front_setting.home_page_certified_doctor_image')}}: </span>
                        <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                           title="Best resolution for this profile will be 636x708"></i>
                    </label>
                    <div class="image-input image-input-outline" data-kt-image-input="true">
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>
                        <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                        {{$style}}"{{$background}}
                        url({{ ($frontSettings['home_page_certified_doctor_image']) ? $frontSettings['home_page_certified_doctor_image'] : asset('web_front/images/healthcare-doctor/doctor-1.png') }}
                        )">
                    </div>
                    <label
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Change image">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        {{ Form::file('home_page_certified_doctor_image',['id'=>'homeDoctorImage','class' => 'd-none','accept' => '.png, .jpg, .jpeg']) }}
                        <input type="hidden" name="avatar_remove">
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                  data-bs-original-title="Cancel image">
                                    <i class="bi bi-x fs-2"></i></span>
                        </div>
                    </div>
                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                </div>
            </div>

            <div class="row mt-3 mb-5">
                <!-- Home Experience Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_experience', __('messages.front_setting.home_page_experience').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_experience', $frontSettings['home_page_experience'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>

                <!-- Home Title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_title', __('messages.front_setting.home_page_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_title', $frontSettings['home_page_title'], ['class' => 'form-control form-control-solid', 'required', 'id' => 'homeTitleId']) }}
                </div>

                <!-- Home description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_description', __('messages.front_setting.home_page_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('home_page_description', $frontSettings['home_page_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5, 'id' => 'shortDescription']) }}
                </div>

                <!-- Home Box Title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_box_title', __('messages.front_setting.home_page_box_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_box_title', $frontSettings['home_page_box_title'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>

                <!-- Home Box description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_box_description', __('messages.front_setting.home_page_box_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('home_page_box_description', $frontSettings['home_page_box_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5]) }}
                </div>
            </div>
            <div class="row mt-3 mb-5">
                <!-- Certified Doctor Text Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_certified_doctor_text', __('messages.front_setting.home_page_certified_doctor_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_certified_doctor_text', $frontSettings['home_page_certified_doctor_text'], ['class' => 'form-control form-control-solid', 'required', 'id' => 'homeDoctorTextId']) }}
                </div>

                <!-- Certified Doctor Title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_certified_doctor_title', __('messages.front_setting.home_page_certified_doctor_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_certified_doctor_title', $frontSettings['home_page_certified_doctor_title'], ['class' => 'form-control form-control-solid', 'required', 'id' => 'homeDoctorTitleId']) }}
                </div>

                <!-- Certified Doctor Description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_certified_doctor_description', __('messages.front_setting.home_page_certified_doctor_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('home_page_certified_doctor_description', $frontSettings['home_page_certified_doctor_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5, 'id' => 'homeDoctorDescription']) }}
                </div>

                <!-- Certified Box Title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_certified_box_title', __('messages.front_setting.home_page_certified_box_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_certified_box_title', $frontSettings['home_page_certified_box_title'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>

                <!-- Certified Box description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_certified_box_description', __('messages.front_setting.home_page_certified_box_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('home_page_certified_box_description', $frontSettings['home_page_certified_box_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5]) }}
                </div>
            </div>

            {{-- Step --}}
            <div class="row mt-3 mb-5">
                <!-- Step 1 Title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_step_1_title', __('messages.front_setting.home_page_step_1_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_step_1_title', $frontSettings['home_page_step_1_title'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>

                <!-- Step 1 description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_step_1_description', __('messages.front_setting.home_page_step_1_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('home_page_step_1_description', $frontSettings['home_page_step_1_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5,'onkeypress' => 'return avoidSpace(event);']) }}
                </div>

                <!-- Step 2 Title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_step_2_title', __('messages.front_setting.home_page_step_2_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_step_2_title', $frontSettings['home_page_step_2_title'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>

                <!-- Step 2 description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_step_2_description', __('messages.front_setting.home_page_step_2_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('home_page_step_2_description', $frontSettings['home_page_step_2_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5,'onkeypress' => 'return avoidSpace(event);']) }}
                </div>

                <!-- Step 3 Title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_step_3_title', __('messages.front_setting.home_page_step_3_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_step_3_title', $frontSettings['home_page_step_3_title'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>

                <!-- Step 3 description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_step_3_description', __('messages.front_setting.home_page_step_3_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('home_page_step_3_description', $frontSettings['home_page_step_3_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5,'onkeypress' => 'return avoidSpace(event);']) }}
                </div>

                <!-- Step 4 Title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_step_4_title', __('messages.front_setting.home_page_step_4_title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_page_step_4_title', $frontSettings['home_page_step_4_title'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>

                <!-- Step 4 description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('home_page_step_4_description', __('messages.front_setting.home_page_step_4_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('home_page_step_4_description', $frontSettings['home_page_step_4_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5,'onkeypress' => 'return avoidSpace(event);']) }}
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
    </script>
    <script src="{{mix('assets/js/front_settings/cms/create-edit.js')}}"></script>
@endsection
