<div id="addAppointmentModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.appointment.new_appointment') }}</h2>
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
            {{ Form::open(['id'=>'calenderAppointmentForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    @if(Auth::user()->hasRole('Patient'))
                        <input type="hidden" name="patient_id" value="{{ Auth::user()->owner_id }}">
                    @else
                        <div class="form-group col-sm-6 mb-5">
                            {{ Form::label('patient_name', __('messages.case.patient').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::select('patient_id', $patients, null, ['class' => 'form-control form-control-solid','required','id' => 'patientIdAppointment','placeholder'=>'Select Patient','data-control' => 'select2']) }}
                        </div>
                    @endif
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('doctor_name', __('messages.case.doctor').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('doctor_id', $doctorArr, null, ['class' => 'form-control form-control-solid','required','id' => 'doctorIdAppointment','placeholder'=>'Select Doctor','data-control' => 'select2']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('opd_date', __('messages.appointment.date').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('opd_date', '', ['id'=>'opdDateAppointment','class' => 'form-control form-control-solid','required', 'autocomplete' => 'off', 'readonly']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('status', __('messages.account.status').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <div class="col-lg-8 d-flex align-items-center">
                            <div class="form-check form-check-solid form-switch fv-row">
                                <input name="is_completed" value="1" class="form-check-input w-35px h-20px"
                                       type="checkbox" {{ ($statusArr === \App\Models\Appointment::STATUS_COMPLETED) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div align="left" class="form-group col-sm-12 mb-5" id="appointmentSlotSection">
                        <?php
                        $style = 'style=';
                        $display = 'display:';
                        $maxHeight = 'max-height:';
                        ?>
                        <div class="doctor-schedule" {{$style}}"{{$display}} none">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="day-name"></span>
                        <span class="schedule-time"></span>
                    </div>
                    <strong class="error-message" {{$style}}"{{$display}} none"></strong>
                    <div class="slot-heading">
                        <strong class="available-slot-heading form-label fs-6 fw-bolder text-gray-700"
                        {{$style}}"{{$display}} none">{{ __('messages.appointment.available_slot').':' }}</strong>
                    </div>
                    <div class="row no-of-slots-available overflow-auto" {{$style}}"{{$maxHeight}} 145px">
                    <div class="available-slot form-group col-sm-12">
                    </div>
                </div>
                <div class="color-information" align="left" {{$style}}"{{$display}} none">
                <span><i class="fa fa-circle fa-xs" aria-hidden="true"> </i> {{ __('messages.appointment.no_available') }}</span>
            </div>
        </div>
        <div class="form-group col-sm-12 mb-5">
            {{ Form::label('problem', __('messages.appointment.description').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('problem', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
        </div>
    </div>
    <div class="text-right">
        {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'btnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light ml-1"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
