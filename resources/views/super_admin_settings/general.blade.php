@extends('super_admin_settings.edit')
@section('title')
    {{ __('messages.general') }}
@endsection
@section('section')
    <div class="card border-0">
        <div class="card-body">
            {{ Form::open(['route' => ['super.admin.settings.update'], 'method' => 'post', 'files' => true, 'id' => 'createSetting']) }}
            <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group mb-5">
                        {{ Form::label('app_name', __('messages.setting.app_name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <span class="required"></span>
                        {{ Form::text('app_name', $settings['app_name'], ['class' => 'form-control form-control-solid','maxLength'=> 30]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-5">
                        {{ Form::label('plan_expire_notification', __('messages.plan_expire_notifications').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <span class="required"></span>
                        {{ Form::text('plan_expire_notification', $settings['plan_expire_notification'], ['class' => 'form-control form-control-solid','maxLength'=> 2]) }}
                    </div>
                </div>

                <!-- App Logo Field -->
                <div class="form-group col-sm-6 mb-5">
                    <div class="row2">
                        <div class="d-block">
                            {{ Form::label('app_logo', __('messages.setting.app_logo').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                               data-placement="top" title="{{  __('messages.setting.image_validation') }}"></i>
                        </div>
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <?php
                            $style = 'style=';
                            $background = 'background-image:';
                            ?>
                            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                            {{$style}}"{{$background}}
                            url({{ ($settings['app_logo']) ? asset($settings['app_logo']) : asset('hms-saas-logo.png') }}
                            )">
                        </div>
                        <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Change app logo">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            {{ Form::file('app_logo',['id'=>'appLogo','class' => 'd-none', 'accept' => '.png, .jpg, .jpeg']) }}
                            <input type="hidden" name="avatar_remove">
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                  data-bs-original-title="Cancel app logo">
                                                                <i class="bi bi-x fs-2"></i></span>
                        </div>
                    </div>
            </div>

            <!-- Favicon Field -->
            <div class="form-group col-sm-6 mb-5">
                <div class="row2">
                    <div class="d-block">
                        {{ Form::label('favicon', __('messages.setting.favicon').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                           data-placement="top" title="{{  __('messages.setting.favicon_validation') }}"></i>
                    </div>
                    <?php
                    $style = 'style=';
                    $background = 'background-image:';
                    ?>
                    <div class="image-input image-input-outline" data-kt-image-input="true">
                        <div class="image-input-wrapper w-60px h-60px bgi-position-center" id="previewImage"
                        {{$style}}"{{$background}}
                        url({{ ($settings['favicon']) ? asset($settings['favicon']) : asset('web/img/hms-saas-favicon.ico') }}
                        )">
                    </div>
                    <label
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Change app logo">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        {{ Form::file('favicon',['id'=>'favicon','class' => 'd-none', 'accept' => '.png, .jpg, .jpeg']) }}
                        <input type="hidden" name="avatar_remove">
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                  data-bs-original-title="Cancel app favicon">
                                                                <i class="bi bi-x fs-2"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                    {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-light btn-active-light-primary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
