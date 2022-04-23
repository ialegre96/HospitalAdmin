<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.radiology_test.radiology_test_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.radiology_test.test_name')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $radiologyTest->test_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.radiology_test.short_name')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $radiologyTest->short_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.radiology_test.test_type')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $radiologyTest->test_type}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.radiology_test.category_name')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$radiologyTest->radiologycategory->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.radiology_test.subcategory')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ (!empty($radiologyTest->subcategory)) ? $radiologyTest->subcategory : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.radiology_test.report_days')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ (!empty($radiologyTest->report_days)) ? $radiologyTest->report_days : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.radiology_test.charge_category')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$radiologyTest->chargecategory->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.radiology_test.standard_charge')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($radiologyTest->standard_charge) }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($radiologyTest->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($radiologyTest->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($radiologyTest->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($radiologyTest->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
