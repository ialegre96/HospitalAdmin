<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.appointment.appointment_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.patient').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$appointment->patient->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.doctor').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$appointment->doctor->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.appointment.doctor_department').(':')  }}</label>
                                <p>
                                    <span class="fw-bolder fs-6 text-gray-800">{{ $appointment->doctor->department->title }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($appointment->created_at)) }}">{{ $appointment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($appointment->updated_at)) }}">{{ $appointment->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.status').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge fs-6 badge-light-{{!empty($appointment->is_completed === \App\Models\Appointment::STATUS_COMPLETED) ? 'success' : 'danger'}}">{{ ($appointment->is_completed === \App\Models\Appointment::STATUS_COMPLETED) ? __('messages.appointment.completed') : __('messages.appointment.pending') }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.appointment.date').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">   {{ isset($appointment->opd_date) ? \Carbon\Carbon::parse($appointment->opd_date)->format('jS M, Y g:i A') : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-lg-8 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.description').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($appointment->problem) ? nl2br(e($appointment->problem)) : __('messages.common.n/a')  !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
