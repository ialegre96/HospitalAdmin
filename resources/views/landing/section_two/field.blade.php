<div class="row">
    <!-- Text Main Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('text_main', __('messages.landing_cms.text_main').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_main', $sectionTwo['text_main'], ['class' => 'form-control form-control-solid','maxLength' => '30']) }}
    </div>

    <!-- Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('text_secondary', __('messages.landing_cms.text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_secondary', $sectionTwo['text_secondary'], ['class' => 'form-control form-control-solid', 'required','maxLength' => '160']) }}
    </div>

    <div class="form-group col-sm-4 mb-5">
        <div class="row2">
            <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                   for="about_us_image"> <span>{{__('messages.landing_cms.card_one_image')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this image will be 100x100"></i>
            </label>
            <?php
            $style = 'style=';
            $background = 'background-image:';
            ?>

            <div class="image-input image-input-outline" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}}
                url({{ isset($sectionTwo['card_one_image']) ? asset($sectionTwo['card_one_image']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
                )">
            </div>
            <label
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                    data-bs-original-title="Change image">
                <i class="bi bi-pencil-fill fs-7"></i>
                {{ Form::file('card_one_image',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
            {{ Form::text('card_one_text', $sectionTwo['card_one_text'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
        </div>

        <!-- Card One Text Secondary Field -->
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('card_one_text_secondary', __('messages.landing_cms.card_one_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_one_text_secondary', $sectionTwo['card_one_text_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
        </div>
    </div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_two_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 100x100"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionTwo['card_two_image']) ? asset($sectionTwo['card_two_image']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_two_image',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
            {{ Form::text('card_two_text', $sectionTwo['card_two_text'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
        </div>

        <!-- Card Two Text Secondary Field -->
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('card_two_text_secondary', __('messages.landing_cms.card_two_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_two_text_secondary', $sectionTwo['card_two_text_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
        </div>
    </div>

<div class="form-group col-sm-4 mb-5">
    <div class="row2">
        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
               for="about_us_image"> <span>{{__('messages.landing_cms.card_third_image')}}: </span>
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Best resolution for this image will be 100x100"></i>
        </label>
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
            {{$style}}"{{$background}}
            url({{ isset($sectionTwo['card_third_image']) ? asset($sectionTwo['card_third_image']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
            )">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>
            {{ Form::file('card_third_image',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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
            {{ Form::label('card_third_text', __('messages.landing_cms.card_third_text').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_third_text', $sectionTwo['card_third_text'], ['class' => 'form-control form-control-solid','maxLength' => '20']) }}
        </div>

        <!-- Card third Text Secondary Field -->
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('card_third_text_secondary', __('messages.landing_cms.card_third_text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('card_third_text_secondary', $sectionTwo['card_third_text_secondary'], ['class' => 'form-control form-control-solid','maxLength' => '90']) }}
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
