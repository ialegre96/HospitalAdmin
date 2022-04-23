<div id="editIpdConsultantInstructionModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_consultant_register.edit_consultant_register') }}</h2>
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
            {{ Form::open(['id'=>'editIpdConsultantNewForm']) }}
            <div class="modal-body scroll-y mx-5 my-7 model-lg">
                <div class="alert alert-danger display-none hide" id="editValidationErrorsBox"></div>
                {{ Form::hidden('id',null,['id'=>'ipdEditConsultantId']) }}
                {{ Form::hidden('ipd_patient_department_id',$ipdPatientDepartment->id) }}
                <div class="row">
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('applied_date', __('messages.ipd_patient_consultant_register.applied_date').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}

                        {{ Form::text('applied_date', null, ['class' => 'form-control form-control-solid appliedDate min-w-170 modelDataPickerzindex', 'id' => 'ipdEditAppliedDate', 'autocomplete' => 'off', 'required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('doctor_id', __('messages.ipd_patient_consultant_register.doctor_id').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}

                        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select form-select-solid doctorId select2Selector','required','placeholder'=>'Select Doctor', 'id' => 'editDoctorId']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('instruction_date', __('messages.ipd_patient_consultant_register.instruction_date').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}

                        {{ Form::text('instruction_date', null, ['class' => 'form-control form-control-solid instructionDate min-w-170', 'autocomplete' => 'off', 'required', 'id' => 'editInstructionDate']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('instruction', __('messages.ipd_patient_consultant_register.instruction').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}

                        {{ Form::textarea('instruction', null, ['class' => 'form-control form-control-solid min-w-170', 'rows' => 4, 'required', 'id' => 'editConsultantInstruction', 'onkeypress' => 'return avoidSpace(event);']) }}
                    </div>
                </div>
                <div class="d-flex mt-5">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnEditIpdConsultantSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
