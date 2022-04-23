<div id="addModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.charge.new_charge') }}</h2>
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
            {{ Form::open(['id'=>'addNewForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('charge_type', __('messages.charge_category.charge_type').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('charge_type', $chargeTypes, null, ['class' => 'form-select form-select-solid','required','id' => 'chargeTypeId','placeholder' => 'Select Charge Type']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('charge_category_id', __('messages.charge.charge_category').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('charge_category_id', (isset($chargeCategories) ? nl2br(e($chargeCategories)) : []), null, ['class' => 'form-select form-select-solid','required','id' => 'chargeCategoryId','placeholder' => 'Select Charge Category']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('code', __('messages.charge.code').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('code', null, ['class' => 'form-control form-control-solid','required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('standard_charge', __('messages.charge.standard_charge').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('standard_charge', null, ['class' => 'form-control price-input form-control-solid','required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                    </div>

                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.birth_report.description').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
                    </div>
                    <div class="d-flex mt-5">
                        {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <button type="button" aria-label="Close" class="btn btn-light btn-active-light-primary me-2"
                                data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

