<div class="row">
    <!-- App Name Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('app_name', __('messages.setting.app_name').':') }}<span class="required">*</span>
        {{ Form::text('app_name', $settings['app_name'], ['class' => 'form-control', 'required']) }}
    </div>

    <!-- Company Name Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('company_name', __('messages.setting.company_name').':') }}<span class="required">*</span>
        {{ Form::text('company_name', $settings['company_name'], ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row">

    <!-- Hospital Email Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('hospital_email', __('messages.setting.hospital_email').':') }}<span class="required">*</span>
        {{ Form::email('hospital_email', $settings['hospital_email'], ['class' => 'form-control', 'required']) }}
    </div>

    <!-- Hospital Phone Field -->
    <div class="form-group col-sm-6 hospitalPhone">
        {{ Form::label('hospital_phone', __('messages.setting.hospital_phone').':') }}<span
                class="required">*</span><br>
        {{ Form::tel('hospital_phone', $settings['hospital_phone'], ['class' => 'form-control','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
        {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>

    <!-- Hospital From Day Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('hospital_from_day', __('messages.setting.hospital_from_day').':') }}<span
                class="required">*</span>
        {{ Form::text('hospital_from_day', $settings['hospital_from_day'], ['class' => 'form-control', 'required']) }}
    </div>

    <!-- Hospital From Time Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('hospital_from_time', __('messages.setting.hospital_from_time').':') }}<span
                class="required">*</span>
        {{ Form::text('hospital_from_time', $settings['hospital_from_time'], ['class' => 'form-control', 'required']) }}
    </div>

    <!-- Address Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('hospital_address', __('messages.setting.address').':') }}<span class="required">*</span>
        {{ Form::text('hospital_address', $settings['hospital_address'], ['class' => 'form-control', 'required']) }}
    </div>

    <!-- Currency Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('current_currency', __('messages.setting.currency').':') }}<span class="required">*</span>
        <select id="currencyType" data-show-content="true" class="form-select form-select-solid"
                name="current_currency">
            @foreach($currencies as $key => $currency)
                <option value="{{$key}}" {{getCurrentCurrency() == $key ? 'selected' : ''}}>
                    {{$currency['symbol']}}&nbsp;&nbsp;&nbsp; {{$currency['name']}}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <!-- App Logo Field -->
    <div class="form-group col-sm-6">
        <div class="row">
            <div class="col-md-4 col-sm-3 col-6">
                {{ Form::label('app_logo', __('messages.setting.app_logo').':') }}<span class="required">*</span>
                <label class="image__file-upload"> {{ __('messages.nurse.choose') }}
                    {{ Form::file('app_logo',['id'=>'appLogo','class' => 'd-none']) }}
                </label>
            </div>
            <div class="col-md-2 col-sm-6 col-6 preview-image-video-container pl-0 mt-1">
                <img id='previewImage' class="img-thumbnail thumbnail-preview settingThumbnailPreview image-stretching"
                     src="{{ ($settings['app_logo']) ? $settings['app_logo'] : asset('assets/img/default_image.jpg') }}"/>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
        {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-secondary']) }}
    </div>
</div>
