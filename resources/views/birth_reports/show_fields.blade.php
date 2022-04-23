<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.birth_report.birth_report_details') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.patient').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$birthReport->patient->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.death_report.case_id').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$birthReport->case_id}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.doctor').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$birthReport->doctor->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.death_report.date').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($birthReport->date)->format('jS M, Y g:i A') }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.death_report.description').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($birthReport->description)?nl2br(e($birthReport->description)):'N/A' !!}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($birthReport->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($birthReport->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($birthReport->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($birthReport->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
