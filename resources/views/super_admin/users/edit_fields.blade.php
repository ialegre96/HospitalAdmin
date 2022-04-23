<div class="row gx-10 mb-5 pt-5">
    <div class="col-md-4">

        <div class="mb-5">
            {{ Form::label('hospital_name', __('messages.hospitals_list.hospital_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('hospital_name', null, ['class' => 'form-control form-control-solid', 'required', 'tabindex' => '1', 'placeholder' => 'Enter Hospital Name', 'pattern'  => '^[a-zA-Z0-9 ]+$',  'title' => 'Hospital Name Not Allowed Special Character']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-5">
            {{ Form::label('username', __('messages.user.hospital_slug').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('username', null, ['class' => 'form-control form-control-solid', 'required', 'tabindex' => '1', 'placeholder' => 'Enter Hospital Slug', 'readonly', 'min' => 12, 'maxlength' => 12]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-5">
            {{ Form::label('email',__('messages.user.email').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::email('email', null, ['class' => 'form-control form-control-solid', 'required', 'placeholder' => 'Enter Email', 'tabindex' => '3']) }}
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-5 myclass">
            {{ Form::label('Phone',__('messages.visitor.phone').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            <br>
{{ Form::tel('phone', null, ['class' => 'form-control form-control-solid', 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5', 'required', 'maxlength' => '11']) }}
<br>
{{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
<span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
<span id="error-msg" class="hide"></span>
</div>
</div>
</div>
<div class="d-flex">
{!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) !!}
<a href="{!! route('super.admin.hospitals.index') !!}"
class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
