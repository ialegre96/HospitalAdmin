<div class="row gx-10 mb-5">
    <div class="col-lg-6">

        <div class="mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('first_name', null, ['class' => 'form-control form-control-solid', 'required', 'tabindex' => '1']) }}
        </div>

        <div class="mb-5">
            {{ Form::label('email',__('messages.user.email').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::email('email', null, ['class' => 'form-control form-control-solid', 'required', 'tabindex' => '3']) }}
        </div>

        <div class="mb-5 myclass">
            {{ Form::label('Phone',__('messages.visitor.phone').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}<br>
            {{ Form::tel('phone', null, ['class' => 'form-control form-control-solid', 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5']) }}
            <br>
            {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
            <span id="error-msg" class="hide"></span>
        </div>

        @if(!$isEdit)
            <div class="mb-5" data-kt-password-meter="true">
                {{ Form::label('password', __('messages.user.password').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::password('password', ['class' => 'form-control form-control-solid', 'required','min' => '6','max' => '10', 'tabindex' => '8']) }}
                <div class="d-flex align-items-center my-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                </div>
            </div>
        @endif

        <div class="mb-5">
            {{ Form::label('dob',__('messages.user.dob').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('dob', null, ['class' => 'form-control form-control-solid', 'id' => 'dob', 'autocomplete' => 'off', 'tabindex' => '10']) }}
        </div>

        <!-- Facebook URL Field -->
        <div class="mb-5">
            {{ Form::label('facebook_url', __('messages.facebook_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('facebook_url', null, ['class' => 'form-control form-control-solid','id'=>'facebookUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
        </div>

        <!-- Instagram URL Field -->
        <div class="mb-5">
            {{ Form::label('instagram_url', __('messages.instagram_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('instagram_url', null, ['class' => 'form-control form-control-solid', 'id'=>'instagramUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
        </div>

        <div class="col-lg-5">
            <div class="justify-content-center">
                {{ Form::label('image', __('messages.common.profile').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mr-3']) }}
            </div>
            @php
                if($isEdit){
                    $image = isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png');
                }else{
                    $image = asset('assets/img/avatar.png');
                }
            @endphp
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}} url({{ $image }})">
            </div>
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                   data-bs-original-title="Change avatar">
                <i class="bi bi-pencil-fill fs-7"></i>
                {{ Form::file('image',['id'=>'profileImage','class' => 'd-none', 'tabindex' => '12', 'accept' => '.png, .jpg, .jpeg']) }}
                <input type="hidden" name="avatar_remove">
            </label>
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                      data-bs-original-title="Cancel avatar">
                                                                <i class="bi bi-x fs-2"></i></span>
                <span
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-image"
                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title=""
                    data-bs-original-title="Remove avatar"><i class="bi bi-x fs-2"></i></span>
            </div>
            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
        </div>

    </div>

    <div class="col-lg-6">

        <div class="mb-5">
            {{ Form::label('last_name',__('messages.user.last_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('last_name', null, ['class' => 'form-control form-control-solid', 'required', 'tabindex' => '2']) }}
        </div>

        @if(!$isEdit)
            <div class="mb-5">
                {{ Form::label('department_id',__('messages.employee_payroll.role').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <span class="text-danger">*</span>
                {{ Form::select('department_id', $role, null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'role', 'placeholder' => 'Select Role', 'data-control' => 'select2']) }}
            </div>
        @endif

        @if(!$isEdit)
            <div class="mb-5 doctor_department d-none">
                {{ Form::label('department_name', __('messages.doctor_department.doctor_department').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::select('doctor_department_id', $doctorDepartments, null, ['class' => 'form-select form-select-solid', 'id' => 'doctorDepartmentId', 'placeholder' => 'Select Department', 'data-control' => 'select2', 'required']) }}
            </div>
        @endif

        <div class="mb-5">
            {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                {{ Form::radio('gender', '0', true, ['class' => 'form-check-input', 'tabindex' => '6']) }} &nbsp;
                <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.female') }}</label>
                {{ Form::radio('gender', '1', false, ['class' => 'form-check-input', 'tabindex' => '7']) }}
            </span>
        </div>

        @if(!$isEdit)
            <div class="mb-5" data-kt-password-meter="true">
                {{ Form::label('password_confirmation', __('messages.user.password_confirmation').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::password('password_confirmation', ['class' => 'form-control form-control-solid','required','min' => '6','max' => '10', 'tabindex' => '9']) }}
                <div class="d-flex align-items-center my-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                </div>
            </div>
        @endif

        <div class="mb-10">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            <div class="col-lg-8 d-flex align-items-center">
                <div class="form-check form-check-solid form-switch fv-row mt-3">
                    <input tabindex="11" name="status" class="form-check-input w-35px h-20px is-active" value="1"
                           type="checkbox"
                           id="allowmarketing" @if($isEdit) {{(isset($user) && ($user->status)) ? 'checked' : ''}} @else
                        {{ 'checked' }} @endif ">
                    <label class="form-check-label" for="allowmarketing"></label>
                </div>
            </div>
        </div>

        <!-- Twitter URL Field -->
        <div class="mb-5">
            {{ Form::label('twitter_url', __('messages.twitter_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('twitter_url', null, ['class' => 'form-control form-control-solid','id'=>'twitterUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
        </div>

        <!-- LinkedIn URL Field -->
        <div class="mb-5">
            {{ Form::label('linkedIn_url', __('messages.linkedIn_url').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('linkedIn_url', null, ['class' => 'form-control form-control-solid','id'=>'linkedInUrl', 'onkeypress' => 'return avoidSpace(event);']) }}
        </div>

    </div>
</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) }}
    <a href="{{ route('users.index') }}"
       class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
