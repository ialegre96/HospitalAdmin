<div id="changePasswordModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.change_password.change_password') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
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
            {{ Form::open(['class'=>'form','id'=>'changePasswordForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="alert alert-danger display-none hide" id="editValidationErrorsBox"></div>
                {{ Form::hidden('user_id',null,['id'=>'pfUserId']) }}
                {{ Form::hidden('is_active',1) }}
                @csrf
                <div class="row">

                    <div class="col-12 fv-row mb-7" data-kt-password-meter="true">
                        <div class="mb-1">
                            {{ Form::label('current password', __('messages.change_password.current_password').':',['class' => 'form-label fw-bolder text-dark fs-6']) }}
                            <span class="required"></span>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" id="pfCurrentPassword"
                                       type="password"
                                       name="password_current" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_current') }}
                                </div>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
                            </div>

                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 fv-row mb-7"  data-kt-password-meter="true">

                        <div class="mb-1">
                            {{ Form::label('current password', __('messages.change_password.new_password').':',['class' => 'form-label fw-bolder text-dark fs-6']) }}
                            <span class="required"></span>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" id="pfNewPassword"
                                       type="password"
                                       name="password" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
                            </div>

                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            </div>

                        </div>
                    </div>

                    <div class="col-12 fv-row mb-7"  data-kt-password-meter="true">
                        <div class="mb-1">
                            {{ Form::label('password_confirmation', __('messages.change_password.confirm_password').':',['class' => 'form-label fw-bolder text-dark fs-6']) }}
                            <span class="required"></span>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" id="pfNewConfirmPassword"
                                       type="password"
                                       name="password_confirmation" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
                            </div>

                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnPrPasswordEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
