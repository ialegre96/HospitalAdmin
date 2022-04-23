<div id="showPrescription" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.prescription.prescription_details') }}</h2>
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
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.patient').(':') }}</label><br>
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
                        <label for="food_allergies"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.food_allergies').(':') }}</label><br>
                        <span id="food_allergies"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="tendency_bleed"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.tendency_bleed').(':') }}</label><br>
                        <span id="tendency_bleed"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="heart_disease"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.heart_disease').(':') }}</label><br>
                        <span id="heart_disease"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="high_blood_pressure"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.high_blood_pressure').(':') }}</label><br>
                        <span id="high_blood_pressure"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="diabetic"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.diabetic').(':') }}</label><br>
                        <span id="diabetic"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="surgery"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.surgery').(':') }}</label><br>
                        <span id="surgery"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="accident"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.accident').(':') }}</label><br>
                        <span id="accident"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="others"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.others').(':') }}</label><br>
                        <span id="others"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="medical_history"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.medical_history').(':') }}</label><br>
                        <span id="medical_history"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="current_medication"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.current_medication').(':') }}</label><br>
                        <span id="current_medication"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="female_pregnancy"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.female_pregnancy').(':') }}</label><br>
                        <span id="female_pregnancy"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="breast_feeding"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.breast_feeding').(':') }}</label><br>
                        <span id="breast_feeding"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="health_insurance"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.health_insurance').(':') }}</label><br>
                        <span id="health_insurance"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="low_income"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.low_income').(':') }}</label><br>
                        <span id="low_income"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="reference"
                               class="fw-bold text-muted mb-1">{{ __('messages.prescription.reference').(':') }}</label><br>
                        <span id="reference"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-3 mb-5">
                        <label for="status"
                               class="fw-bold text-muted mb-1">{{ __('messages.common.status').(':') }}</label><br>
                        <span id="status"
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
