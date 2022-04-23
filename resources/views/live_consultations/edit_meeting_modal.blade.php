<div id="editModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.live_consultation.edit_live_meeting') }}</h2>
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
                {{ Form::hidden('live_meeting_id',null,['id'=>'liveMeetingId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('consultation_title', __('messages.live_consultation.consultation_title').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('consultation_title', '', ['class' => 'form-control edit-consultation-title form-control-solid','required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultation_date', __('messages.live_consultation.consultation_date').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('consultation_date', '', ['class' => 'form-control edit-consultation-date form-control-solid','required', 'autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultation_duration_minutes', __('messages.live_consultation.consultation_duration_minutes').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::number('consultation_duration_minutes', '', ['class' => 'form-control edit-consultation-duration-minutes form-control-solid','required', 'min' => '0', 'max' => '720']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('staff_list', __('messages.live_consultation.staff_list').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('staff_list[]', $users, getLoggedInUserId(), ['class' => 'form-select form-select-solid editUserId', 'required', 'multiple' => true, 'data-control'=>'select2']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('host_video',__('messages.live_consultation.host_video').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <br>
                        <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                            <label
                                class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.live_consultation.enable') }}</label>&nbsp;&nbsp;
                            {{ Form::radio('host_video', \App\Models\LiveConsultation::HOST_ENABLE, false, ['class' => 'form-check-input host-enable']) }} &nbsp;
                            <label
                                class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.live_consultation.disabled') }}</label>
                            {{ Form::radio('host_video', \App\Models\LiveConsultation::HOST_DISABLED, true, ['class' => 'form-check-input host-disabled']) }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('participant_video',__('messages.live_consultation.client_video').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <br>
                        <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
                            <label
                                class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.live_consultation.enable') }}</label>&nbsp;&nbsp;
                            {{ Form::radio('participant_video', \App\Models\LiveConsultation::CLIENT_ENABLE, false, ['class' => 'form-check-input client-enable']) }} &nbsp;
                            <label
                                class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.live_consultation.disabled') }}</label>
                            {{ Form::radio('participant_video', \App\Models\LiveConsultation::CLIENT_DISABLED, true, ['class' => 'form-check-input client-disabled']) }}
                        </span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.testimonial.description').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('description', '', ['class' => 'form-control edit-description form-control-solid', 'rows' => 3]) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-3','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
