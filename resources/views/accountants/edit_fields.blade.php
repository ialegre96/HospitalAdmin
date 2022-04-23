<div class="alert alert-danger display-none hide" id="customValidationErrorsBox"></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name',__('messages.user.first_name').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span>
            {{ Form::text('first_name', null, ['class' => 'form-control form-control-solid','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name',__('messages.user.last_name').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span>
            {{ Form::text('last_name', null, ['class' => 'form-control form-control-solid','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email',__('messages.user.email').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span>
            {{ Form::email('email', null, ['class' => 'form-control form-control-solid','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('phone',__('messages.user.phone').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            {{ Form::tel('phone', null, ['class' => 'form-control form-control-solid','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
            <span id="error-msg" class="hide"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group',__('messages.user.blood_group').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select form-select-solid', 'id' => 'bloodGroup','placeholder'=>'Select Blood Group']) }}
        </div>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <span class="required"></span>
        {{ Form::text('designation', null, ['class' => 'form-control form-control-solid','required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <span class="required"></span>
        {{ Form::text('qualification', null, ['class' => 'form-control form-control-solid','required']) }}
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('dob', null, ['class' => 'form-control form-control-solid','id' => 'birthDate','autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender',__('messages.user.gender').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span> &nbsp;<br>
            <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
            {{ Form::radio('gender', '0', true, ['class' => 'form-check-input']) }}
                 <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.female') }}</label>&nbsp;
            {{ Form::radio('gender', '1',false, ['class' => 'form-check-input']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status',__('messages.common.status').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox" value="1"
                       tabindex="8" {{(isset($user) && ($user->status)) ? 'checked' : ''}} >
            </div>
        </div>
    </div>
    <div class="form-group col-md-4 mb-5">
        <div class="row2">
            {{ Form::label('image',__('messages.common.profile').(':'), ['class' => 'fs-5 fw-bold mb-2 text-gray-700 d-block']) }}
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}}
                url({{ isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png')}})">
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
<div class="row mt-3">
    <div class="col-md-12 mb-3">
        <h5>{{__('messages.user.address_details')}}</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address1',__('messages.user.address1').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('address1', isset($accountant->address->address1) ? $accountant->address->address1 : null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address2',__('messages.user.address2').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('address2', isset($accountant->address->address2) ? $accountant->address->address2 : null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('city',__('messages.user.city').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('city', isset($accountant->address->city) ? $accountant->address->city : null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('zip',__('messages.user.zip').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('zip', isset($accountant->address->zip) ? $accountant->address->zip : null, ['class' => 'form-control form-control-solid', 'maxlength' => '6','minlength' => '6']) }}
        </div>
    </div>
    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('accountants.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{__('messages.common.cancel')}}</a>
    </div>
</div>
