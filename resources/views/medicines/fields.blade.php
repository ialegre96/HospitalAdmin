<!-- Name Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('name', __('messages.medicine.medicine').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
    <span class="required"></span>
    {{ Form::text('name', null, ['class' => 'form-control form-control-solid','minlength' => 2, 'id' => 'medicineNameId']) }}
</div>

<!-- Category Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('category_id', __('messages.medicine.category').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
    <span class="required"></span>
    {{ Form::select('category_id', $categories, (isset($medicine)) ? $medicine->category_id : null, ['class' => 'form-select form-select-solid', 'placeholder' => 'Select Category', 'id' => 'categoryId']) }}
</div>

<!-- Name Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('brand_id', __('messages.medicine.brand').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
    <span class="required"></span>
    {{ Form::select('brand_id', $brands,  (isset($medicine)) ? $medicine->brand_id : null, ['class' => 'form-select form-select-solid', 'placeholder' => 'Select Brand', 'id' => 'brandId']) }}
</div>

<!-- Salt Composition Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('salt_composition', __('messages.medicine.salt_composition').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
    <span
        class="required"></span>
    {{ Form::text('salt_composition', null, ['class' => 'form-control form-control-solid','required']) }}
</div>

<!-- Buying Price Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('buying_price', __('messages.medicine.buying_price').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
    <span class="required"></span>
    {{ Form::text('buying_price', null, ['class' => 'form-control price-input form-control-solid']) }}
</div>

<!-- Selling Price Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('selling_price', __('messages.medicine.selling_price').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
    <span class="required"></span>
    {{ Form::text('selling_price', null, ['class' => 'form-control price-input form-control-solid']) }}
</div>

<!-- Effect Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('side_effects', __('messages.medicine.side_effects').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
    {{ Form::textarea('side_effects', null, ['class' => 'form-control form-control-solid', 'rows'=>4]) }}
</div>

<!-- Effect Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('description', __('messages.medicine.description').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows'=>4]) }}
</div>

<!-- Submit Field -->
<div class="d-flex mt-5">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'saveBtn']) }}
    <a href="{{ route('medicines.index') }}"
       class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
