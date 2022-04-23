<div id="showBillingModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.billing_detail') }}</h2>
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
                        <label for="plan_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.subscription_plans.plan_name').(':') }}</label><br>
                        <span id="plan_name"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="transaction"
                               class="fw-bold text-muted mb-1">{{ __('messages.subscription_plans.transaction').(':') }}</label><br>
                        <span id="transaction"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="amount"
                               class="fw-bold text-muted mb-1">{{ __('messages.subscription_plans.amount').(':') }}</label><br>
                        <span id="amount" class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5 text-break">
                        <label for="frequency"
                               class="fw-bold text-muted mb-1">{{ __('messages.subscription_plans.frequency').(':') }}</label><br>
                        <span id="frequency"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="start_date"
                               class="fw-bold text-muted mb-1">{{ __('messages.subscription_plans.start_date').(':') }}</label><br>
                        <span id="start_date"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="end_date"
                               class="fw-bold text-muted mb-1">{{ __('messages.subscription_plans.end_date').(':') }}</label><br>
                        <span id="end_date"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="trail_end_date"
                               class="fw-bold text-muted mb-1">{{ __('messages.subscription_plans.trail_end_date').(':') }}</label><br>
                        <span id="trail_end_date"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="status"
                               class="fw-bold text-muted mb-1">{{ __('messages.common.status').(':') }}</label><br>
                        <span id="status"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
