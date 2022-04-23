<div id="addCredential" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.live_consultation.add_credential') }}</h2>
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
            {{ Form::open(['id'=>'addZoomForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="credentialValidationErrorsBox"></div>
                {{ Form::hidden('user_id',getLoggedInUserId(),['id'=>'userId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('zoom_api_key', __('messages.live_consultation.zoom_api_key').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('zoom_api_key', '', ['class' => 'form-control form-control-solid','required', 'id' => 'zoomApiKey', 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('zoom_api_secret', __('messages.live_consultation.zoom_api_secret').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('zoom_api_secret', '', ['class' => 'form-control form-control-solid','required', 'id' => 'zoomApiSecret', 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="d-flex mt-5">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary','id' => 'btnZoomSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
