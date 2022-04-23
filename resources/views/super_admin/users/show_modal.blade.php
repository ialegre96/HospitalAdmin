<div id="showUser" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.user.user_details') }}</h2>
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
                        <label for="first_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.user.first_name').(':') }}</label><br>
                        <span id="first_name"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="last_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.user.last_name').(':') }}</label><br>
                        <span id="last_name"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="last_name"
                               class="fw-bold text-muted mb-1">{{ __('messages.user.username').(':') }}</label><br>
                        <span id="username" class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5 text-break">
                        <label for="userEmail" class="fw-bold text-muted mb-1">{{ __('messages.user.email').(':') }}</label><br>
                        <span id="userEmail"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="role"
                               class="fw-bold text-muted mb-1">{{ __('messages.sms.role').(':') }}</label><br>
                        <span id="role"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="userPhone"
                               class="fw-bold text-muted mb-1">{{ __('messages.user.phone').(':') }}</label><br>
                        <span id="userPhone"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="userGender"
                               class="fw-bold text-muted mb-1">{{ __('messages.user.gender').(':') }}</label><br>
                        <span id="userGender"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="userDob"
                               class="fw-bold text-muted mb-1">{{ __('messages.user.dob').(':') }}</label><br>
                        <span id="userDob"
                              class="fw-bolder fs-6 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="userStatus"
                               class="fw-bold text-muted mb-1">{{ __('messages.user.status').(':') }}</label><br>
                        <span id="userStatus"
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
                    <div class="form-group col-sm-4 mb-5">
                        <label for="userProfilePicture"
                               class="fw-bold text-muted mb-1">{{ __('messages.profile.profile').(':') }}</label><br>
                        <div class="symbol symbol-100px symbol-fixed position-relative">
                            <img id="userProfilePicture" src="#" alt="image"
                                 class="fw-bolder fs-6 text-gray-800 showSpan object-fit-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
