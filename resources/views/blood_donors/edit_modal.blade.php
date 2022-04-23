<div id="editModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{  __('messages.blood_donor.edit_blood_donor') }}</h2>
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
                {{ Form::hidden('blood_donor_id',null,['id'=>'bloodDonorId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.blood_donor.name').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('name', '', ['id'=>'editName','class' => 'form-control form-control-solid','required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('age', __('messages.blood_donor.age').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::number('age', '', ['id'=>'editAge','class' => 'form-control form-control-solid','required','min' => '1', 'max' => '100']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('gender', __('messages.user.gender').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                            <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                            {{ Form::radio('gender', '0', false, ['class' => 'form-check-input', 'id' => 'male']) }} &nbsp;
                            <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.female') }}</label>
                            {{ Form::radio('gender', '1', false, ['class' => 'form-check-input', 'id' => 'female']) }}
                        </span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('blood_group', __('messages.blood_donor.blood_group').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select form-select-solid select2Selector fw-bold', 'required', 'id' => 'editBloodGroup', 'placeholder' => 'Select Blood Group', 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('last_donate_date', __('messages.blood_donor.last_donation_date').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('last_donate_date', '', ['id'=>'editLastDonationDate','class' => 'form-control form-control-solid','required', 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="text-right mt-5">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
