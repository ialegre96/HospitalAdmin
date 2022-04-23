<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('name', __('messages.package.service').':') }}<label class="required">*</label>
            {{ Form::text('name', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('quantity', __('messages.service.quantity').':') }}<label class="required">*</label>
            {{ Form::text('quantity', null, ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '5','required']) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('rate', __('messages.service.rate').':') }}<label class="required">*</label>
            {{ Form::text('rate', null, ['class' => 'form-control price-input', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '7','required']) }}
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('status', __('messages.common.status').(':')) }}
        <label class="switch switch-label switch-outline-primary-alt d-block">
            <input name="status" class="switch-input" type="checkbox" value="1"
                    {{(!isset($insurance)) ? 'checked':(($insurance->status) ? 'checked' : '')}}>
            <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
        </label>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('messages.common.description').':') }}
            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary', 'id' => 'btnSave']) }}
        <a href="{{ route('services.index') }}" class="btn btn-secondary">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
