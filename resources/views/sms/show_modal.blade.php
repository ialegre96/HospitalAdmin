<div id="showSms" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.sms.sms_details') }}</h2>
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
                        <label for="send_to"
                               class="fw-bold text-muted mb-1">{{ __('messages.sms.send_to').(':') }}</label><br>
                        <span id="send_to"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="user_role"
                               class="fw-bold text-muted mb-1">{{ __('messages.employee_payroll.role').(':') }}</label><br>
                        <span id="user_role"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="sms_phone"
                               class="fw-bold text-muted mb-1">{{ __('messages.user.phone').(':') }}</label><br>
                        <span id="sms_phone"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="sms_date"
                               class="fw-bold text-muted mb-1">{{  __('messages.sms.date').(':') }}</label><br>
                        <span id="sms_date"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="send_by"
                               class="fw-bold text-muted mb-1">{{ __('messages.sms.send_by').(':') }}</label><br>
                        <span id="send_by"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="updated_on"
                               class="fw-bold text-muted mb-1">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="updated_on"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label for="sms_message"
                               class="fw-bold text-muted mb-1">{{ __('messages.sms.message').(':') }}</label><br>
                        <span id="sms_message"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
