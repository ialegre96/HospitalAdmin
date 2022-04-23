<div class="row">
    <div class="form-group col-sm-6 mb-5">
        <div class="row2">
            <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                   for="about_us_image"> <span>{{__('messages.landing_cms.image')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this image will be 1200x800"></i>
            </label>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}}
                url({{ isset($sectionOne['img_url']) ? asset($sectionOne['img_url']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
                )">
            </div>
            <label
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                    data-bs-original-title="Change image">
                <i class="bi bi-pencil-fill fs-7"></i>
                {{ Form::file('img_url',['class' => 'd-none','accept' => '.png, .jpg, .jpeg']) }}
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

    <!-- Text Main Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('text_main', __('messages.landing_cms.text_main').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_main', $sectionOne['text_main'], ['class' => 'form-control form-control-solid', 'id' => 'textMain','maxLength' => '45']) }}
    </div>

    <!-- Text Secondary Field -->
    <div class="form-group col-sm-12 mb-5">
        {{ Form::label('text_secondary', __('messages.landing_cms.text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_secondary', $sectionOne['text_secondary'], ['class' => 'form-control form-control-solid', 'id' => 'textSecondary', 'required','maxLength' => '135']) }}
    </div>

    <div class="row">
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
            {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-light btn-active-light-primary']) }}
        </div>
    </div>
</div>
