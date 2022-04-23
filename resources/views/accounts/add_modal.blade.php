<div id="AddModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.account.new_account') }}</h2>
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
                        {{ Form::label('name', __('messages.account.account').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('name', null, ['class' => 'form-control form-control-solid','required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.account.description').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
                    </div>
                    <div class="form-group col-sm-4 mb-5 d-flex">
                        {{ Form::label('status', __('messages.account.status').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <div class="col-lg-8 d-flex align-items-start ms-2 mt-1">
                            <div class="form-check form-check-solid form-switch fv-row">
                                <input name="status" value="1" class="form-check-input w-35px h-20px" type="checkbox"
                                       id="allowmarketing" checked="checked">
                                <label class="form-check-label" for="allowmarketing"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-8 mb-5 d-flex align-items-start">
                        {{ Form::label('type', __('messages.account.type').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                            <label class="form-label fs-6 fw-bolder text-gray-700 mx-3 mb-0">{{ __('messages.account.debit') }}</label>&nbsp;&nbsp;
                            {{ Form::radio('type', '1', false, ['class' => 'form-check-input']) }} &nbsp;
                            <label class="form-label fs-6 fw-bolder text-gray-700 mx-3 mb-0">{{ __('messages.account.credit') }}</label>
                            {{ Form::radio('type', '2', true, ['class' => 'form-check-input']) }}
                        </span>
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'btnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
