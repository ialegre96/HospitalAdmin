<div id="editModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.medicine.edit_medicine_category') }}</h2>
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
            {{ Form::open(['id'=>'editForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="editValidationErrorsBox"></div>
                {{ Form::hidden('category_id',null,['id'=>'category_id']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name',__('messages.medicine.category').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('name', '', ['id'=>'edit_name','class' => 'form-control form-control-solid','required']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('active', __('messages.common.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-35px h-20px is-active" name="is_active" type="checkbox"
                                   value="1"
                                   checked="" id="edit_is_active">
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-5">
                    {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" aria-label="Close" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">Cancel
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
