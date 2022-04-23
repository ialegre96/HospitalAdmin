@extends('settings.edit')
@section('title')
    {{ __('messages.general') }}
@endsection
@section('section')
    <div class="card border-0">
        <div class="card-body">
            {{ Form::open(['route' => ['settings.update'], 'method' => 'post', 'files' => true, 'id' => 'createSetting']) }}
            <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
            <div class="row">
                <!-- App Name Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('app_name', __('messages.setting.app_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('app_name', $settings['app_name'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>
                <!-- Company Name Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('company_name', __('messages.setting.company_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('company_name', $settings['company_name'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>
            </div>
            <div class="row">
                <!-- Hospital Email Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('hospital_email', __('messages.setting.hospital_email').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::email('hospital_email', $settings['hospital_email'], ['class' => 'form-control form-control-solid', 'required']) }}
                </div>
                <!-- Hospital Phone Field -->
                <div class="form-group col-sm-6 mb-5 hospitalPhone">
                    {{ Form::label('hospital_phone', __('messages.setting.hospital_phone').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <br>
                    {{ Form::tel('hospital_phone', $settings['hospital_phone'], ['class' => 'form-control form-control-solid','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                    {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
                    <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                    <span id="error-msg" class="hide"></span>
                </div>
                <!-- Hospital From Day Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('hospital_from_day', __('messages.setting.hospital_from_day').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('hospital_from_day', $settings['hospital_from_day'], ['class' => 'form-control form-control-solid', 'required', 'onkeypress' => 'return avoidSpace(event);'])}}
                </div>
                <!-- Hospital From Time Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('hospital_from_time', __('messages.setting.hospital_from_time').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('hospital_from_time', $settings['hospital_from_time'], ['class' => 'form-control form-control-solid', 'required', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
                <!-- Address Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('hospital_address', __('messages.setting.address').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('hospital_address', $settings['hospital_address'], ['class' => 'form-control form-control-solid', 'required', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
                <!-- Currency Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('current_currency', __('messages.setting.currency').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <select id="currencyType" data-show-content="true" class="form-select form-select-solid"
                            name="current_currency">
                        @foreach($currencies as $key => $currency)
                            <option value="{{$key}}" {{getCurrentCurrency() == $key ? 'selected' : ''}}>
                                {{$currency['symbol']}}&nbsp;&nbsp;&nbsp; {{$currency['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- About us Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us', __('messages.about_us').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::textarea('about_us', $settings['about_us'], ['class' => 'form-control form-control-solid', 'required', 'rows' => 5, 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>
            </div>
            <div class="row">
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
                            url({{ ($settings['app_logo']) ? $settings['app_logo'] : asset('hms-saas-logo.png') }})">
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
                    <div class="image-input image-input-outline" data-kt-image-input="true">
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>
                        <div class="image-input-wrapper w-60px h-60px bgi-position-center" id="previewImage"
                        {{$style}}"{{$background}}
                        url({{ ($settings['favicon']) ? $settings['favicon'] : asset('web/img/hms-saas-favicon.ico') }}
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
            <hr>
            <div class="row mt-3 mb-5">
                <div class="col-md-12 mb-3">
                    <h5>{{ __('messages.setting.social_details') }}</h5>
                </div>

                <!-- Facebook URL Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('facebook_url', __('messages.facebook_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('facebook_url', $settings['facebook_url'], ['class' => 'form-control form-control-solid','id'=>'facebookUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>

                <!-- Twitter URL Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('twitter_url', __('messages.twitter_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('twitter_url', $settings['twitter_url'], ['class' => 'form-control form-control-solid','id'=>'twitterUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>

                <!-- Instagram URL Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('instagram_url', __('messages.instagram_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('instagram_url', $settings['instagram_url'], ['class' => 'form-control form-control-solid', 'id'=>'instagramUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>

                <!-- LinkedIn URL Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('linkedIn_url', __('messages.linkedIn_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('linkedIn_url', $settings['linkedIn_url'], ['class' => 'form-control form-control-solid','id'=>'linkedInUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
                </div>

            </div>
    <div class="form-group col-lg-12 col-md-12 d-flex justify-content-start mb-3">
        <div class="form-check form-check-solid form-switch fv-row mb-3">
            <input tabindex="11" name="enable_google_recaptcha" class="form-check-input w-35px h-20px is-active"
                   value="1"
                   {{ (isset($settings['enable_google_recaptcha']) && $settings['enable_google_recaptcha']) ? 'checked' : '' }} type="checkbox"
                   id="allowmarketing">
            <label class="form-check-label" for="allowmarketing"></label>
        </div>
        <span class="custom-switch-description fw-bolder">{{ __('messages.setting.enable_google_reCAPTCHA') }}</span>
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
