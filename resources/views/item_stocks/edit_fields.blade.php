<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('item_category_id', __('messages.item_stock.item_category').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('item_category_id', $itemCategories, $itemStock->item_category_id, ['id' => 'itemCategory','class' => 'form-select form-select-solid','required','placeholder' => 'Select Item Category', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('item_id', __('messages.item_stock.item').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('item_id', [null], $itemStock->item_id, ['id' => 'items','class' => 'form-select form-select-solid', 'required', 'disabled', 'placeholder' => 'Select Item']) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('supplier_name', __('messages.item_stock.supplier_name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('supplier_name', null, ['id'=>'supplierName','class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('store_name', __('messages.item_stock.store_name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('store_name', null, ['id'=>'storeName','class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('quantity', __('messages.item_stock.quantity').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('quantity', null, ['id'=>'quantity','class' => 'form-control form-control-solid','required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '4','minlength' => '1']) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('purchase_price', __('messages.item_stock.purchase_price').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('purchase_price', null, ['id'=>'purchasePrice','class' => 'form-control price-input form-control-solid','required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '6','minlength' => '1']) }}
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.item_stock.description').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
        <div class="form-group mb-5">
            {{ Form::label('attachment', __('messages.document.attachment').':', ['class' => 'fs-5 fw-bold mb-2 d-block']) }}
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                <div class="image-input-wrapper w-125px h-125px" id="previewImage"
                {{$style}}"{{$background}}
                url({{ !empty($itemStock->item_stock_url) ? $itemStock->item_stock_url : asset('assets/img/default_image.jpg') }}
                )">
            </div>

            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change"
                   data-bs-toggle="tooltip"
                   data-bs-dismiss="click"
                   title="Change attachment">
                <i class="bi bi-pencil-fill fs-7"></i>

                <input type="file" name="attachment" id="attachment" class="document-file">
                <input type="hidden" name="avatar_remove"/>
                </label>

                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                      data-kt-image-input-action="cancel"
                      data-bs-toggle="tooltip"
                      data-bs-dismiss="click"
                      title="Cancel attachment">
                     <i class="bi bi-x fs-2"></i>
                </span>
                <span
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-image"
                    data-kt-image-input-action="remove"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Remove attachment">
                 <i class="bi bi-x fs-2"></i>
                </span>
                @if(!empty($itemStock->item_stock_url))
                    <span
                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow btn-view"
                        data-bs-toggle="tooltip"
                        data-bs-dismiss="click"
                        title="View attachment">
                                <a href="{{ $itemStock->item_stock_url }}" class="" target="_blank"><i
                                        class="bi bi-eye-fill fs-6"></i></a>
                            </span>
                @endif
            </div>

        </div>
    </div>
    <div class="form-group col-sm-12">
{{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnSave']) }}
<a href="{!! route('item.stock.index') !!}"
   class="btn btn-light btn-active-light-primary">{!! __('messages.common.cancel') !!}</a>
</div>
</div>
