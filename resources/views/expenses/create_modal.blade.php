<div id="addModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.expense.new_expense') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                               fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                </button>
            </div>
            {{ Form::open(['id'=>'addNewForm', 'files' => true]) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('expense_head', __('messages.expense.expense_head').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('expense_head', $expenseHeads, null, ['class' => 'form-select form-select-solid', 'required', 'id' => 'expenseId', 'placeholder' => __('messages.expense.select_expense_head'), 'data-control' => 'select2']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('name', __('messages.expense.name').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('name', null, ['class' => 'form-control form-control-solid','required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('date', __('messages.incomes.date').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('date', null, ['class' => 'form-control form-control-solid','required', 'id' => 'date', 'autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('invoice_number', __('messages.incomes.invoice_number').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('invoice_number', null, ['class' => 'form-control form-control-solid']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('amount', __('messages.incomes.amount').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('amount', null, ['id'=>'amount','class' => 'form-control form-control-solid price-input', 'autocomplete' => 'off', 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('attachment', __('messages.incomes.attachment').':', ['class' => 'fs-5 fw-bold mb-2 d-block']) }}
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <div class="image-input-wrapper w-125px h-125px" id="previewImage"
                            {{$style}}"{{$background}} url({{ asset('assets/img/default_image.jpg') }})">
                        </div>

                        <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
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
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.incomes.description').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-3','id' => 'btnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
