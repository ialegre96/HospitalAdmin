<div class="alert alert-danger display-none hide" id="customValidationErrorsBox"></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('first_name', null, ['class' => 'form-control form-control-solid', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name', __('messages.user.last_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('last_name', null, ['class' => 'form-control form-control-solid', 'required']) }}
        </div>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('department_name', __('messages.doctor_department.doctor_department').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('doctor_department_id', $doctorsDepartments, $doctor->doctor_department_id, ['class' => 'form-select form-select-solid', 'id' => 'doctorDepartmentId', 'placeholder' => 'Select Department', 'data-control' => 'select2','required']) }}
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::email('email', null, ['class' => 'form-control form-control-solid', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('designation', null, ['class' => 'form-control form-control-solid', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mobile-overlapping mb-5">
            {{ Form::label('phone', __('messages.user.phone').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::tel('phone', null, ['class' => 'form-control form-control-solid', 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
            <span id="error-msg" class="hide"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('qualification', null, ['class' => 'form-control form-control-solid', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('dob', null, ['class' => 'form-control form-control-solid','id' => 'birthDate','autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group', __('messages.user.blood_group').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select form-select-solid', 'id' => 'bloodGroup', 'placeholder' => 'Select Blood Group', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span> &nbsp;<br>
            <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                {{ Form::radio('gender', '0', true, ['class' => 'form-check-input']) }} &nbsp;
                <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.female') }}</label>
                {{ Form::radio('gender', '1', false, ['class' => 'form-check-input']) }}
            </span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox"
                       value="1" {{(isset($user) && ($user->status)) ? 'checked' : ''}}>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6 col-md-6 mb-5">
        <div class="row2">
            <label class="fs-5 fw-bold mb-2 d-block" for="image"> <span>{{__('messages.profile.profile')}}: </span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="Best resolution for this logo will be 325x375"></i>
            </label>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}="{{$background}}
                url({{ isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png') }})"></div>
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                   title="Change profile">
                <i class="bi bi-pencil-fill fs-7"></i>
                <input type="file" name="image" id="profileImage" accept=".png, .jpg, .jpeg, .gif"/>
                <input type="hidden" name="avatar_remove"/>
            </label>
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                  title="Cancel profile">
                        <i class="bi bi-x fs-2"></i>
                </span>
                <span
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-image"
                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    title="Remove profile">
                        <i class="bi bi-x fs-2"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('specialist', __('messages.doctor.specialist').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('specialist', (isset($doctor) ? $doctor->specialist : ''), ['class' => 'form-control form-control-solid','required']) }}
        </div>
    </div>
</div>
<hr>
<div class="row mt-3">
    <div class="col-md-12 mb-3">
        <h5>{{ __('messages.user.address_details') }}</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address1', __('messages.user.address1').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('address1', isset($doctor->address->address1) ? $doctor->address->address1 : null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address2', __('messages.user.address2').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('address2', isset($doctor->address->address2) ? $doctor->address->address2 : null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('city', __('messages.user.city').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('city', isset($doctor->address->city) ? $doctor->address->city : null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('zip', __('messages.user.zip').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('zip', isset($doctor->address->zip) ? $doctor->address->zip : null, ['class' => 'form-control form-control-solid', 'maxlength' => '6','minlength' => '6']) }}
        </div>
    </div>
</div>
<hr>
<div class="row mt-3 mb-5">
    <div class="col-md-12 mb-3">
        <h5>{{ __('messages.setting.social_details') }}</h5>
    </div>

    <!-- Facebook URL Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('facebook_url', __('messages.facebook_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('facebook_url', null, ['class' => 'form-control form-control-solid','id'=>'facebookUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

    <!-- Twitter URL Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('twitter_url', __('messages.twitter_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('twitter_url', null, ['class' => 'form-control form-control-solid','id'=>'twitterUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

    <!-- Instagram URL Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('instagram_url', __('messages.instagram_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('instagram_url', null, ['class' => 'form-control form-control-solid', 'id'=>'instagramUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

    <!-- LinkedIn URL Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('linkedIn_url', __('messages.linkedIn_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('linkedIn_url', null, ['class' => 'form-control form-control-solid','id'=>'linkedInUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
    </div>

</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
    <a href="{{ route('doctors.index') }}"
       class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
