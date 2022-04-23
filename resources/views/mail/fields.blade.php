<div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
<div class="row mt-10">
    <div class="col-md-6 mb-5">
        <div class="form-group">
            {{ Form::label('to', __('messages.email.to').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::email('to', null, ['class' => 'form-control form-control-solid','required', 'id' => 'emailId']) }}
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <div class="form-group">
            {{ Form::label('subject', __('messages.email.subject').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('subject', null, ['class' => 'form-control form-control-solid','required']) }}
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <div class="form-group">
            {{ Form::label('message', __('messages.email.message').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('message', null, ['class' => 'form-control form-control-solid','rows' => 6,'required']) }}
        </div>
    </div>
    <div class="form-group col-md-6 mb-5">
        <div class="row">
            <div class="col-sm-4 col-6">
                {{ Form::label('file', __('messages.email.attachment').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <div class="image-input image-input-outline" data-kt-image-input="true">
                    <?php
                    $style = 'style=';
                    $background = 'background-image:';
                    ?>
                    <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                    {{$style}}"{{$background}} url({{ asset('assets/img/default_image.jpg') }})">
                </div>
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                       data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                       data-bs-original-title="Change attachment">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    {{ Form::file('file',['id'=>'documentImage','class' => 'd-none document-file']) }}
                    <input type="hidden" name="avatar_remove">
                </label>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                      data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                          data-bs-original-title="Cancel attachment">
                                                                <i class="bi bi-x fs-2"></i></span>
                    <span
                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-image"
                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title=""
                        data-bs-original-title="Remove attachment"><i class="bi bi-x fs-2"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.sms.send'), ['class' => 'btn btn-primary me-3']) }}
        <a href="{{ route('mail') }}"
           class="btn btn-light btn-active-light-primary">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
