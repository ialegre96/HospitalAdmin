<div class="row">

    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('text_main', __('messages.landing_cms.text_main').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_main', $landingAboutUs['text_main'], ['class' => 'form-control form-control-solid','maxLength' => '20' ]) }}
    </div>
    <?php
    $style = 'style=';
    $background = 'background-image:';
    ?>
    <div class="form-group col-sm-6 mb-5">
        <div class="row2">
            <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                   for="about_us_image"> <span>{{__('messages.landing_cms.main_img_one')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this image will be 750x560"></i>
            </label>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}}
                url({{ isset($landingAboutUs['main_img_one']) ? asset($landingAboutUs['main_img_one']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
                )">
            </div>
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                   data-bs-original-title="Change image">
                <i class="bi bi-pencil-fill fs-7"></i>
                {{ Form::file('main_img_one',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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

<div class="form-group col-sm-6 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.main_img_two')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 635x665"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($landingAboutUs['main_img_two']) ? asset($landingAboutUs['main_img_two']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('main_img_two',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
               title="Best resolution for this image will be 40x40"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($landingAboutUs['card_img_one']) ? asset($landingAboutUs['card_img_one']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_img_one',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
            {{ Form::label('card_one_text', __('messages.landing_cms.card_one_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_one_text', $landingAboutUs['card_one_text'], ['class' => 'form-control form-control-solid','maxLength' => '20' ]) }}
        </div>

        <!-- Card One Text Secondary Field -->
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('card_one_text_secondary', __('messages.landing_cms.card_one_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_one_text_secondary', $landingAboutUs['card_one_text_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '135']) }}
        </div>
    </div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_two_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 40x40"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($landingAboutUs['card_img_two']) ? asset($landingAboutUs['card_img_two']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
               data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_img_two',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
            {{ Form::label('card_two_text', __('messages.landing_cms.card_two_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_two_text', $landingAboutUs['card_two_text'], ['class' => 'form-control form-control-solid','maxLength' => '20' ]) }}
        </div>

        <!-- Card Two Text Secondary Field -->
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('card_two_text_secondary', __('messages.landing_cms.card_two_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_two_text_secondary', $landingAboutUs['card_two_text_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '135']) }}
        </div>
    </div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_three_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 40x40"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($landingAboutUs['card_img_three']) ? asset($landingAboutUs['card_img_three']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_img_three',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
            {{ Form::label('card_three_text', __('messages.landing_cms.card_three_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_three_text', $landingAboutUs['card_three_text'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
        </div>

        <!-- Card third Text Secondary Field -->
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('card_three_text_secondary', __('messages.landing_cms.card_three_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_three_text_secondary', $landingAboutUs['card_three_text_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '135']) }}
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
