{{--<div class="alert alert-danger display-none" id="customValidationErrorsBox"></div>--}}
<div class="row gx-10 my-5">
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('footer_text', __('messages.footer_setting.footer_text').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span>
            {{ Form::textarea('footer_text', $settings['footer_text'], ['class' => 'form-control form-control-solid', 'required', 'id' => 'footerText','tabindex' => '1','rows'=> '5','maxLength'=> 270]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span>
            {{ Form::email('email', $settings['email'], ['class' => 'form-control form-control-solid', 'required']) }}
        </div>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('phone',__('messages.sms.phone_number').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {!! Form::tel('phone', $settings['phone'], ['class' => 'form-control form-control-solid', 'required','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) !!}
        {!! Form::hidden('prefix_code',null,['id'=>'prefix_code']) !!}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address', __('messages.footer_setting.address').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span>
            {{ Form::text('address', $settings['address'], ['class' => 'form-control form-control-solid','maxLength'=> 60]) }}
        </div>
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
        {{ Form::label('linkedin_url', __('messages.linkedIn_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('linkedin_url', $settings['linkedin_url'], ['class' => 'form-control form-control-solid','id'=>'linkedInUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>
</div>

<div class="d-flex">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'btnSave']) }}
    {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-light btn-active-light-primary me-2']) }}
</div>
