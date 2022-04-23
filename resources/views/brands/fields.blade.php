<div class="row gx-10 mb-5">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('name', __('messages.medicine.brand').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span>
            {{ Form::text('name', null, ['id'=>'name','class' => 'form-control form-control-solid','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('phone', __('messages.user.phone').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <br>
            {{ Form::tel('phone', null, ['class' => 'form-control form-control-solid','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
            <span id="error-msg" class="hide"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::email('email', null, ['id'=>'email','class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnSave']) }}
        <a href="{{ route('brands.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
