<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('name', __('messages.package.service').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <label class="required"></label>
            {{ Form::text('name', null, ['class' => 'form-control form-control-solid','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('quantity', __('messages.service.quantity').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <label class="required"></label>
            {{ Form::text('quantity', null, ['class' => 'form-control form-control-solid', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '5','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('rate', __('messages.service.rate').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <label class="required"></label>
            {{ Form::text('rate', null, ['class' => 'form-control price-input form-control-solid', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '7','required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <div class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox"
                   value="1" {{(!isset($service)) ? 'checked':(($service->status) ? 'checked' : '')}}>
        </div>
    </div>
    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnSave']) }}
        <a href="{{ route('services.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
