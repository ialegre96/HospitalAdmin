<div id="showEmployeePayrolls" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.employee_payroll.employee_payroll_details') }}</h2>
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
                    <div class="form-group col-sm-4 mb-5">
                        <label for="sr_no"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.sr_no').(':') }}</label><br>
                        <span id="sr_no"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="payroll_id"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.payroll_id').(':') }}</label><br>
                        <span id="payroll_id"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="payroll_role"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.role').(':') }}</label><br>
                        <span id="payroll_role"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="employee_full_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.employee').(':') }}</label><br>
                        <span id="employee_full_name"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="payroll_month"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.month').(':') }}</label><br>
                        <span id="payroll_month"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="payroll_year"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.year').(':') }}</label><br>
                        <span id="payroll_year"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="employee_status"
                               class="fw-bold text-muted mb-1">{{ __('messages.common.status').(':') }}</label><br>
                        <span id="employee_status"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="salary"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.basic_salary').(':') }}</label><br>
                        <span id="salary"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="allowance"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.allowance').(':') }}</label><br>
                        <span id="allowance"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="deductions"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.deductions').(':') }}</label><br>
                        <span id="deductions"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="net_salary"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.net_salary').(':') }}</label><br>
                        <span id="net_salary"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="created_on"
                               class="fw-bold text-muted mb-1">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="created_on"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
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
