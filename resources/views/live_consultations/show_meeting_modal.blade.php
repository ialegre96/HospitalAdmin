<div class="modal fade" tabindex="-1" id="showModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.live_meetings') }}</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                </div>
            </div>

            <div class="modal-body">
                {{ Form::hidden('live_consultation_id',null,['id'=>'showLiveConsultationId']) }}
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">{{ __('messages.live_consultation.consultation_title').(':')  }}</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800" id="meetingTitle"></span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">{{ __('messages.live_consultation.consultation_date').(':')  }}</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800" id="meetingDate"></span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">{{ __('messages.live_consultation.consultation_duration_minutes').(':')  }}</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800" id="meetingMinutes"></span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">{{ __('messages.live_consultation.host_video').(':')  }}</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800" id="meetingHost"></span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">{{ __('messages.live_consultation.client_video').(':')  }}</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800" id="meetingParticipant"></span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">{{ __('messages.testimonial.description').(':')  }}</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800" id="meetingDescription"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
