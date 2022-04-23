<div id="startModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="start-modal-title"></h5>
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
                {{ Form::hidden('live_consultation_id',null,['id'=>'startLiveConsultationId']) }}
                <div class="row">
                    <div class="form-group col-sm-4  mb-5">
                        {{ Form::label('host', __('messages.live_consultation.host_video').(':'), ['class' => 'fw-bold text-muted mb-1']) }}
                        <br>
                        <span class="fw-bolder fs-6 text-gray-800 host-name"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        {{ Form::label('date', __('messages.live_consultation.consultation_date').(':'), ['class' => 'fw-bold text-muted mb-1']) }}
                        <br>
                        <span class="fw-bolder fs-6 text-gray-800 date"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        {{ Form::label('duration', __('messages.live_consultation.duration').(':'), ['class' => 'fw-bold text-muted mb-1']) }}
                        <br>
                        <span class="fw-bolder fs-6 text-gray-800 minutes"></span>
                    </div>
                </div>
                <?php
                $style = 'style=';
                $border = 'border:';
                ?>
                <hr {{$style}}"{{$border}} 1px solid #e0e4e8;">
                <div class="row">
                    <div class="text-left col-sm-8 mb-5">
                        {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'fw-bold text-muted mb-1']) }}
                        <br>
                        <span class="fw-bolder fs-6 text-gray-800 status"></span>
                    </div>
                    <div class="text-end col-sm-4 mt-4">
                        <a class="btn btn-sm btn-flex btn-light btn-primary fw-bolder start" href="" target="_blank">
                            <i class="fas fa-video"></i> {{ getLoggedInUser()->hasRole('Patient') ? __('messages.live_consultation.join_now') : __('messages.live_consultation.start_now') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
