<div class="alert alert-danger display-none hide" id="customValidationErrorsBox"></div>
<div class="row gx-10 mb-5">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::text('first_name', null, ['class' => 'form-control form-control-solid', 'required', 'tabindex' => '1']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name', __('messages.user.last_name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::text('last_name', null, ['class' => 'form-control form-control-solid', 'required', 'tabindex' => '2']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::email('email', null, ['class' => 'form-control form-control-solid', 'required', 'tabindex' => '3']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'form-label fs-6 fw-bolder required text-gray-700 mb-3']) }}
            {{ Form::text('designation', null, ['class' => 'form-control form-control-solid', 'tabindex' => '4']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mobile-overlapping  mb-5">
            {{ Form::label('phone', __('messages.user.phone').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}<span class="required"></span><br>
            {{ Form::tel('phone', null, ['class' => 'form-control form-control-solid', 'id' => 'phoneNumber', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5']) }}
            {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
            <span id="error-msg" class="hide"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'form-label fs-6 fw-bolder required text-gray-700 mb-3']) }}
            {{ Form::text('qualification', null, ['class' => 'form-control form-control-solid', 'tabindex' => '8']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('dob', null, ['class' => 'form-control form-control-solid', 'id' => 'birthDate', 'autocomplete' => 'off', 'tabindex' => '9']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group', __('messages.user.blood_group').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select form-select-solid', 'id' => 'bloodGroup', 'placeholder' => 'Select Blood Group', 'data-control' => 'select2', 'tabindex' => "10"]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5" data-kt-password-meter="true">
            {{ Form::label('password', __('messages.user.password').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::password('password', ['class' => 'form-control form-control-solid','required','min' => '6','max' => '10', 'tabindex' => '11']) }}
            <div class="d-flex align-items-center my-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5" data-kt-password-meter="true">
            {{ Form::label('password_confirmation', __('messages.user.password_confirmation').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::password('password_confirmation', ['class' => 'form-control form-control-solid','required','min' => '6','max' => '10', 'tabindex' => '12']) }}
            <div class="d-flex align-items-center my-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            &nbsp;<br>
            <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                {{ Form::radio('gender', '0', true, ['class' => 'form-check-input', 'tabindex' => '6']) }} &nbsp;
                <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.female') }}</label>
                {{ Form::radio('gender', '1', false, ['class' => 'form-check-input', 'tabindex' => '7']) }}
            </span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <div class="form-check form-switch form-check-custom form-check-solid mt-3">
                <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox" value="1"
                       tabindex="11" checked>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <div class="row2">
            {{ Form::label('image', __('messages.profile.profile').':', ['class' => 'fs-5 fw-bold mb-2 d-block']) }}
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}} url({{ asset('assets/img/avatar.png') }})">
            </div>

            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change"
                   data-bs-toggle="tooltip"
                   data-bs-dismiss="click"
                   title="Change profile">
                <i class="bi bi-pencil-fill fs-7"></i>

                <input type="file" name="image" id="profileImage" accept=".png, .jpg, .jpeg, .gif"/>
                <input type="hidden" name="avatar_remove"/>
                </label>

                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                      data-kt-image-input-action="cancel"
                      data-bs-toggle="tooltip"
                      data-bs-dismiss="click"
                      title="Cancel profile">
                        <i class="bi bi-x fs-2"></i>
                </span>
                <span
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-image"
                    data-kt-image-input-action="remove"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Remove profile">
                        <i class="bi bi-x fs-2"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3 mb-5">
    <div class="col-md-12 mb-3">
        <h5>{{ __('messages.user.address_details') }}</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address1', __('messages.user.address1').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('address1', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address2', __('messages.user.address2').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('address2', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('city', __('messages.user.city').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('city', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('zip', __('messages.user.zip').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('zip', null, ['class' => 'form-control form-control-solid', 'maxlength' => '6','minlength' => '6']) }}
        </div>
    </div>
</div>

<div class="d-flex">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) }}
    <a href="{{ route('lab-technicians.index') }}" class="btn btn-light btn-active-light-primary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
