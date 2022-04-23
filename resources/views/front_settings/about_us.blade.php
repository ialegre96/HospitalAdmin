@extends('front_settings.index')
@section('title')
    {{ __('messages.front_settings') }}
@endsection
@section('section')
    <div class="card">
        <div class="card-header">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.front_setting.about_us_details') }}</h3>
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
                    {{ Form::text('about_us_title', $frontSettings['about_us_title'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>
                <!-- About Us description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_description', __('messages.front_setting.about_us_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('about_us_description', $frontSettings['about_us_description'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5]) }}
                </div>
                <!-- About Us mission Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_mission', __('messages.front_setting.about_us_mission').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('about_us_mission', $frontSettings['about_us_mission'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5]) }}
                </div>
                <!-- About US Image Field -->
                <div class="form-group col-sm-6 mb-5">
                    <div class="row2">
                        {{ Form::label('about_us_image', __('messages.front_setting.about_us_image').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block']) }}
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <?php
                            $style = 'style=';
                            $background = 'background-image:';
                            ?>
                            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                            {{$style}}"{{$background}}
                            url({{ ($frontSettings['about_us_image']) ? $frontSettings['about_us_image'] : asset('assets/img/default_image.jpg') }}
                            )">
                        </div>
                        <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Change image">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            {{ Form::file('about_us_image',['id'=>'aboutUsImage','class' => 'd-none','accept' => '.png, .jpg, .jpeg']) }}
                            <input type="hidden" name="avatar_remove">
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                  data-bs-original-title="Cancel image">
                                <i class="bi bi-x fs-2"></i></span>
                        </div>
                    </div>
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
