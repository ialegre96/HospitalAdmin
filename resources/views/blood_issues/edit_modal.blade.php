<div id="editModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{  __('messages.blood_issue.edit_blood_issue') }}</h2>
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
                {{ Form::hidden('blood_issue_id',null,['id'=>'bloodIssueId']) }}
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('issue_date', __('messages.blood_issue.issue_date').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('issue_date', '', ['id'=>'editIssueDate','class' => 'form-control form-control-solid','required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('doctor_id', __('messages.blood_issue.doctor_name').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select form-select-solid fw-bold select2Selector', 'required', 'id' => 'editDoctorName', 'placeholder' => 'Select Doctor Name', 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('patient_id', __('messages.blood_issue.patient_name').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select form-select-solid fw-bold select2Selector', 'required', 'id' => 'editPatientName', 'placeholder' => 'Select Patient Name', 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('donor_id', __('messages.blood_issue.donor_name').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('donor_id', $donors, null, ['class' => 'form-select form-select-solid fw-bold select2Selector', 'required', 'id' => 'editDonorName', 'placeholder' => 'Select Donor Name', 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('blood_group', __('messages.user.blood_group').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('blood_group', [], null, ['class' => 'form-select form-select-solid fw-bold select2Selector', 'required', 'id' => 'editBloodGroup', 'placeholder' => 'Select Blood Group', 'data-control' => 'select2', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('amount', __('messages.blood_issue.amount').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('amount', '', ['id'=>'editAmount','class' => 'form-control form-control-solid price-input price','required', 'maxlength' => '9']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('remarks', __('messages.blood_issue.remarks').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('remarks', '', ['id' => 'editRemarks','class' => 'form-control form-control-solid','rows' => 3,'cols' => 3]) }}
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
