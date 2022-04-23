<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('department_id', __('messages.issued_item.department_id').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('department_id', $data['userTypes'], null, ['id' => 'userType','class' => 'form-select form-select-solid','required','placeholder' => 'Select User Type', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('user_id', __('messages.issued_item.user_id').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('user_id', [null], null, ['id' => 'issueTo','class' => 'form-select form-select-solid','required','disabled', 'data-control' => 'select2', 'placeholder' => 'Select User']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('issued_by', __('messages.issued_item.issued_by').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('issued_by', null, ['id'=>'issuedBy', 'class' => 'form-control form-control-solid', 'required form-control-solid']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('issued_date', __('messages.issued_item.issued_date').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('issued_date', null, ['id'=>'issueDate', 'class' => 'form-control form-control-solid', 'required', 'autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('return_date', __('messages.issued_item.return_date').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('return_date', null, ['id'=>'returnDate', 'class' => 'form-control form-control-solid', 'autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('item_category_id', __('messages.issued_item.item_category').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('item_category_id', $data['itemCategories'], null, ['id' => 'itemCategory','class' => 'form-select form-select-solid','required','placeholder' => 'Select Item Category', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('item_id', __('messages.issued_item.item').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('item_id', [null], null, ['id' => 'items','class' => 'form-select form-select-solid','required','disabled', 'data-control' => 'select2', 'placeholder' => 'Select Item']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-5 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::hidden('available_quantity', null, ['id'=>'availableQuantity']) }}
            {{ Form::label('quantity', __('messages.issued_item.quantity').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            (<span class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.item.available_quantity') . ':' }} <span id="showAvailableQuantity">0</span></span>)
            {{ Form::number('quantity', null, ['id'=>'quantity','class' => 'form-control form-control-solid', 'required', 'min' => 1, 'disabled']) }}
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.item_stock.description').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
        </div>
    </div>
    <div class="form-group col-sm-12">
{{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnSave']) }}
<a href="{{ route('issued.item.index') }}"
   class="btn btn-light btn-active-light-primary">{{ __('messages.common.cancel')  }}</a>
</div>
</div>
