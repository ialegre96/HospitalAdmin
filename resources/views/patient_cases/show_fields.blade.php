<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.case.case_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        @if (!Auth::user()->hasRole('Doctor|Nurse'))
                            <a href="{{route('patient-cases.edit',['patient_case' => $patientCase->id])}}"
                               class="btn btn-sm btn-primary me-2">{{ __('messages.common.edit') }}</a>
                        @endif
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.operation_report.case_id').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $patientCase->case_id}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.patient').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$patientCase->patient->user->full_name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.phone').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ !empty($patientCase->phone)?$patientCase->phone:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.doctor').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$patientCase->doctor->user->full_name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.case_date').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{\Carbon\Carbon::parse($patientCase->date)->format('jS M,Y g:i A') }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.fee').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($patientCase->fee,2) }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_at').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($patientCase->created_at)) }}">{{ $patientCase->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($patientCase->updated_at)) }}">{{ $patientCase->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.status').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge badge-light-{{($patientCase->status == 1) ? 'success' : 'danger'}}">{{ ($patientCase->status == 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                                </p>
                            </div>
                            <div class="col-lg-12 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.description').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($patientCase->description)?nl2br(e($patientCase->description)):__('messages.common.n/a') !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
