<div id="showModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.faqs.show') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                </button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="editValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('messages.faqs.question').':'}}</label>
                        <br><span id="showQuestion"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('messages.faqs.answer').':'}}</label>
                        <br><span id="showAnswer"></span>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <button type="button" class="btn btn-light btn-active-light-primary me-2" data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
