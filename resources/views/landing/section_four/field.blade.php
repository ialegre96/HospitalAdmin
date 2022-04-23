<?php
$style = 'style=';
$background = 'background-image:';
?>
<div class="row">
    <!-- Text Main Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('text_main', __('messages.landing_cms.text_main').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_main', $sectionFour['text_main'], ['class' => 'form-control form-control-solid','maxLength' => '30']) }}
    </div>

    <!-- Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('text_secondary', __('messages.landing_cms.text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_secondary', $sectionFour['text_secondary'], ['class' => 'form-control form-control-solid', 'required','maxLength' => '160']) }}
    </div>

    <div class="form-group col-sm-4 mb-5">
        <div class="row2">
            <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                   for="about_us_image"> <span>{{__('messages.landing_cms.card_one_image')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this image will be 50x50"></i>
            </label>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px bgi-position-center background-fit-contain"
                     id="previewImage"
                {{$style}}"{{$background}}
                url({{ isset($sectionFour['img_url_one']) ? asset($sectionFour['img_url_one']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
                )">
            </div>
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                   data-bs-original-title="Change image">
                <i class="bi bi-pencil-fill fs-7"></i>
                {{ Form::file('img_url_one',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
        {{ Form::label('card_text_one', __('messages.landing_cms.card_one_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_one', $sectionFour['card_text_one'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
    </div>

    <!-- Card One Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_text_one_secondary', __('messages.landing_cms.card_one_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_one_secondary', $sectionFour['card_text_one_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
    </div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_two_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 50x50"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center background-fit-contain"
                 id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFour['img_url_two']) ? asset($sectionFour['img_url_two']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('img_url_two',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
        {{ Form::label('card_text_two', __('messages.landing_cms.card_two_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_two', $sectionFour['card_text_two'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
    </div>

    <!-- Card Two Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_text_two_secondary', __('messages.landing_cms.card_two_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_two_secondary', $sectionFour['card_text_two_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
    </div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_three_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 50x50"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center background-fit-contain"
                 id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFour['img_url_three']) ? asset($sectionFour['img_url_three']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('img_url_three',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
        {{ Form::label('card_text_three', __('messages.landing_cms.card_three_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_three', $sectionFour['card_text_three'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
    </div>

    <!-- Card third Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_text_three_secondary', __('messages.landing_cms.card_three_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_three_secondary', $sectionFour['card_text_three_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
    </div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_four_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 50x50"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center background-fit-contain"
                 id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFour['img_url_four']) ? asset($sectionFour['img_url_four']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('img_url_four',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
        {{ Form::label('card_text_four', __('messages.landing_cms.card_four_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_four', $sectionFour['card_text_four'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
    </div>

    <!-- Card third Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_text_four_secondary', __('messages.landing_cms.card_four_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_four_secondary', $sectionFour['card_text_four_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
    </div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_five_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 50x50"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center background-fit-contain"
                 id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFour['img_url_five']) ? asset($sectionFour['img_url_five']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('img_url_five',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
        {{ Form::label('card_text_five', __('messages.landing_cms.card_five_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_five', $sectionFour['card_text_five'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
    </div>

    <!-- Card third Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_text_five_secondary', __('messages.landing_cms.card_five_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_five_secondary', $sectionFour['card_text_five_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
    </div>
</div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_six_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 50x50"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center background-fit-contain"
                 id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionFour['img_url_six']) ? asset($sectionFour['img_url_six']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('img_url_six',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
        {{ Form::label('card_text_six', __('messages.landing_cms.card_six_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_six', $sectionFour['card_text_six'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
    </div>

    <!-- Card third Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('card_text_six_secondary', __('messages.landing_cms.card_six_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('card_text_six_secondary', $sectionFour['card_text_six_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
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
