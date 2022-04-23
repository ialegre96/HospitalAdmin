<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.investigation_report.investigation_report_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.investigation_report.patient').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $investigationReport->patient->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.investigation_report.doctor').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$investigationReport->doctor->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.investigation_report.date').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($investigationReport->date)->format('jS M, Y g:i A') }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.investigation_report.title').(':') }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $investigationReport->title }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.investigation_report.description').(':') }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! (!empty($investigationReport->description)) ? nl2br(e($investigationReport->description)) : __('messages.common.n/a')  !!}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.document.attachment').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">
                                    @if(!empty($investigationReport->attachment_url))
                                        <a href="{{$investigationReport->attachment_url}}" target="_blank">View</a>
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.status').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge fs-6 badge-light-{{($investigationReport->status == 1) ? 'success' : 'danger'}}">{{ ($investigationReport->status == 1) ? 'Solved' : 'Not Solved' }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($investigationReport->created_at)) }}">{{ $investigationReport->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($investigationReport->updated_at)) }}">{{ $investigationReport->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
