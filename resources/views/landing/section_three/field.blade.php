<div class="row">
    <div class="form-group col-sm-4 mb-5">
        <div class="row2">
            <?php
            $style = 'style=';
            $background = 'background-image:';
            ?>
            <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                   for="about_us_image"> <span>{{__('messages.landing_cms.card_one_image')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this image will be 1400x1089"></i>
            </label>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}}
                url({{ isset($sectionThree['img_url']) ? asset($sectionThree['img_url']) : asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}
                )">
            </div>
            <label
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                    data-bs-original-title="Change image">
                <i class="bi bi-pencil-fill fs-7"></i>
                {{ Form::file('img_url',['class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
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

    <div class="col-sm-8">
        <!-- Text Main Field -->
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('text_main', __('messages.landing_cms.text_main').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('text_main', $sectionThree['text_main'], ['class' => 'form-control form-control-solid','maxLength' => '30']) }}
        </div>

        <!-- Text Secondary Field -->
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('text_secondary', __('messages.landing_cms.text_secondary').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('text_secondary', $sectionThree['text_secondary'], ['class' => 'form-control form-control-solid', 'required','maxLength' => '160']) }}
        </div>
    </div>

    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('text_one', __('messages.landing_cms.text_one').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_one', $sectionThree['text_one'], ['class' => 'form-control form-control-solid','maxLength' => '50']) }}
    </div>

    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('text_two', __('messages.landing_cms.text_two').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_two', $sectionThree['text_two'], ['class' => 'form-control form-control-solid','maxLength' => '50']) }}
    </div>

    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('text_three', __('messages.landing_cms.text_three').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_three', $sectionThree['text_three'], ['class' => 'form-control form-control-solid','maxLength' => '50']) }}
    </div>

    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('text_four', __('messages.landing_cms.text_four').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_four', $sectionThree['text_four'], ['class' => 'form-control form-control-solid','maxLength' => '50']) }}
    </div>

    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('text_five', __('messages.landing_cms.text_five').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('text_five', $sectionThree['text_five'], ['class' => 'form-control form-control-solid','maxLength' => '50']) }}
    </div>

    <div class="row">
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
            {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-light btn-active-light-primary']) }}
        </div>
    </div>
</div>
