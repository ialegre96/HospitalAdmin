<div id="showPatientAdmission" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.patient_admission.details') }}</h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="row">
                    <div class="form-group col-sm-3 mb-5">
                        <label for="patient_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.case.patient').(':') }}</label><br>
                        <span id="patient_name"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="doctor_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.case.doctor').(':') }}</label><br>
                        <span id="doctor_name"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="admission_id"
                               class="fw-bold text-muted mb-1">{{ __('messages.bill.admission_id').(':') }}</label><br>
                        <span id="admission_id"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="admission_date"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.admission_date').(':') }}</label><br>
                        <span id="admission_date"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="discharge_date"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.discharge_date').(':') }}</label><br>
                        <span id="discharge_date"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="package"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.package').(':') }}</label><br>
                        <span id="package"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="insurance"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.insurance').(':') }}</label><br>
                        <span id="insurance"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="admission_bed"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.bed').(':') }}</label><br>
                        <span id="admission_bed"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="policy_no"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.policy_no').(':') }}</label><br>
                        <span id="policy_no"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="agent_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.agent_name').(':') }}</label><br>
                        <span id="agent_name"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="guardian_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.guardian_name').(':') }}</label><br>
                        <span id="guardian_name"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="guardian_relation"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.guardian_relation').(':') }}</label><br>
                        <span id="guardian_relation"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="guardian_contact"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.guardian_contact').(':') }}</label><br>
                        <span id="guardian_contact"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="guardian_address"
                               class="fw-bold text-muted mb-1">{{ __('messages.patient_admission.guardian_address').(':') }}</label><br>
                        <span id="guardian_address"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="patient_status"
                               class="fw-bold text-muted mb-1">{{ __('messages.common.status').(':') }}</label><br>
                        <span id="patient_status"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="created_on"
                               class="fw-bold text-muted mb-1">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="created_on"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="updated_on"
                               class="fw-bold text-muted mb-1">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="updated_on"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
