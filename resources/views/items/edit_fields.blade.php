<div class="row gx-10 mb-5">
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('name', __('messages.item.name').':', ['class' => 'form-label fs-6 fw-bolder required text-gray-700 mb-3']) }}
            {{  Form::text('name', null, ['id'=>'name','class' => 'form-control form-control-solid', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('item_category_id', __('messages.item.item_category').':', ['class' => 'form-label fs-6 fw-bolder required text-gray-700 mb-3']) }}
            {{ Form::select('item_category_id', $itemCategories, null, ['class' => 'form-select form-select-solid', 'required', 'id' => 'itemCategory', 'data-control' => 'select2', 'placeholder' => 'Select Item Category']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('unit', __('messages.item.unit').':', ['class' => 'form-label fs-6 required fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('unit', null, ['id'=>'unit','class' => 'form-control form-control-solid', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '4','minlength' => '1']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.item.description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
        </div>
    </div>
    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnEditSave']) }}
        <a href="{{ route('items.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
