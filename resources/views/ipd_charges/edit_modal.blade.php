<div id="editIpdChargesModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_charges.edit_charge') }}</h2>
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
            {{ Form::open(['id'=>'editIpdChargesForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                @if($ipdPatientDepartment->bill)
                    <div class="alert alert-warning">
                        <span>Note: After adding charge you must need to re-generate Bill.</span>
                    </div>
                @endif
                <div class="alert alert-danger display-none hide" id="editValidationErrorsBox"></div>
                {{ Form::hidden('id',null,['id'=>'ipdChargesId']) }}
                <div class="row">
                    <div class="form-group col-md-6 mb-5">
                        {{ Form::label('date', __('messages.ipd_patient_charges.date').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('date', null, ['class' => 'form-control form-control-solid modelDataPickerzindex','id' => 'ipdEditChargeDate','autocomplete' => 'off', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('charge_type_id', __('messages.ipd_patient_charges.charge_type_id').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('charge_type_id', $chargeTypes, null, ['class' => 'form-select form-select-solid select2Selector', 'id' => 'editChargeTypeId', 'required','placeholder'=>'Select Charge Type', 'data-is-charge-edit' => 1]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('charge_category_id', __('messages.ipd_patient_charges.charge_category_id').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('charge_category_id', [null], null, ['class' => 'form-select form-select-solid select2Selector', 'id' => 'editChargeCategoryId', 'required', 'disabled', 'data-is-charge-edit' => 1]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('charge_id', __('messages.ipd_patient_charges.charge_id').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('charge_id', [null], null, ['class' => 'form-select form-select-solid select2Selector', 'id' => 'editChargeId', 'required', 'disabled', 'data-is-charge-edit' => 1]) }}
                    </div>
                    <div class="form-group col-md-6 mb-5">
                        <div class="form-group">
                            {{ Form::label('standard_charge', __('messages.ipd_patient_charges.standard_charge').':',['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::text('standard_charge', null, ['class' => 'form-control form-control-solid price-input','id' => 'editIpdStandardCharge', 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-5">
                        <div class="form-group">
                            {{ Form::label('applied_charge', __('messages.ipd_patient_charges.applied_charge').':',['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <span class="applied_charge">(<span id="appliedChargeId"></span>)</span>
                            {{ Form::text('applied_charge', null, ['class' => 'form-control form-control-solid price-input','id' => 'editIpdAppliedCharge', 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-5">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnEditCharges','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
