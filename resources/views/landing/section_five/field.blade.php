<?php
$style = 'style=';
$background = 'background-image:';
?>
<div class="row">
    <div class="form-group col-sm-12 mb-5">
        <div class="row2">
            <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                   for="about_us_image"> <span>{{__('messages.landing_cms.main_image')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this image will be 715x535"></i>
            </label>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}}
                url({{ isset($sectionFive['main_img_url']) ? asset($sectionFive['main_img_url']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
                )">
            </div>
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                   data-bs-original-title="Change image">
                <i class="bi bi-pencil-fill fs-7"></i>
                {{ Form::file('main_img_url',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
                <input type="hidden" name="avatar_remove">
            </label>
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                  data-bs-original-title="Cancel image">
                                    <i class="bi bi-x fs-2"></i></span>
        </div>
    </div>
    <div class="form-text">Allowed file types: png, jpg, jpeg, svg.</div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_one_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 70x70"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFive['card_img_url_one']) ? asset($sectionFive['card_img_url_one']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_img_url_one',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
            <input type="hidden" name="avatar_remove">
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
              data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
              data-bs-original-title="Cancel image">
                                    <i class="bi bi-x fs-2"></i></span>
    </div>
</div>
<div class="form-text">Allowed file types: png, jpg, jpeg, svg.</div>
</div>

<div class="col-sm-8">
    <!-- Card One Text Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_one_number', __('messages.landing_cms.card_one_number').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::number('card_one_number', $sectionFive['card_one_number'], ['class' => 'form-control form-control-solid','maxLength' => '4' ,'onKeyPress'=>'if(this.value.length==4) return false;']) }}
    </div>

    <!-- Card One Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_one_text', __('messages.landing_cms.card_one_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_one_text', $sectionFive['card_one_text'], ['class' => 'form-control form-control-solid','maxLength' => '15']) }}
    </div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_two_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 70x70"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFive['card_img_url_two']) ? asset($sectionFive['card_img_url_two']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_img_url_two',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
            <input type="hidden" name="avatar_remove">
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
              data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
              data-bs-original-title="Cancel image">
                                    <i class="bi bi-x fs-2"></i></span>
    </div>
</div>
<div class="form-text">Allowed file types: png, jpg, jpeg, svg.</div>
</div>

<div class="col-sm-8">
    <!-- Card Two Text Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_two_number', __('messages.landing_cms.card_two_number').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::number('card_two_number', $sectionFive['card_two_number'], ['class' => 'form-control form-control-solid','maxLength' => '4' ,'onKeyPress'=>'if(this.value.length==4) return false;']) }}
    </div>

    <!-- Card Two Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_two_text', __('messages.landing_cms.card_two_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_two_text', $sectionFive['card_two_text'], ['class' => 'form-control form-control-solid','maxLength' => '15']) }}
    </div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_three_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 70x70"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFive['card_img_url_three']) ? asset($sectionFive['card_img_url_three']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_img_url_three',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
            <input type="hidden" name="avatar_remove">
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
              data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
              data-bs-original-title="Cancel image">
                                    <i class="bi bi-x fs-2"></i></span>
    </div>
</div>
<div class="form-text">Allowed file types: png, jpg, jpeg, svg.</div>
</div>

<div class="col-sm-8">
    <!-- Card third Text Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_three_number', __('messages.landing_cms.card_three_number').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::number('card_three_number', $sectionFive['card_three_number'], ['class' => 'form-control form-control-solid','maxLength' => '4' ,'onKeyPress'=>'if(this.value.length==4) return false;']) }}
    </div>

    <!-- Card third Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_three_text', __('messages.landing_cms.card_three_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_three_text', $sectionFive['card_three_text'], ['class' => 'form-control form-control-solid','maxLength' => '15']) }}
    </div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_four_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 70x70"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFive['card_img_url_four']) ? asset($sectionFive['card_img_url_four']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_img_url_four',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
            <input type="hidden" name="avatar_remove">
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
              data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
              data-bs-original-title="Cancel image">
                                    <i class="bi bi-x fs-2"></i></span>
    </div>
</div>
<div class="form-text">Allowed file types: png, jpg, jpeg, svg.</div>
</div>

<div class="col-sm-8">
    <!-- Card third Text Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_four_number', __('messages.landing_cms.card_four_number').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::number('card_four_number', $sectionFive['card_four_number'], ['class' => 'form-control form-control-solid','maxLength' => '4','onKeyPress'=>'if(this.value.length==4) return false;']) }}
    </div>

    <!-- Card third Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_four_text', __('messages.landing_cms.card_four_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_four_text', $sectionFive['card_four_text'], ['class' => 'form-control form-control-solid','maxLength' => '15']) }}
    </div>
</div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
        {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-light btn-active-light-primary']) }}
    </div>
</div>
</div>
