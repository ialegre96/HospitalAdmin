<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.pathology_test.pathology_test_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.test_name')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$pathologyTest->test_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.short_name')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$pathologyTest->short_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.test_type')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$pathologyTest->test_type}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.category_name')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$pathologyTest->pathologycategory->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.unit')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ (!empty($pathologyTest->unit)) ? $pathologyTest->unit : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.subcategory')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ (!empty($pathologyTest->subcategory)) ? $pathologyTest->subcategory : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.method')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ (!empty($pathologyTest->method)) ? $pathologyTest->method : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.report_days')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ (!empty($pathologyTest->report_days)) ? nl2br(e($pathologyTest->report_days)) : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.charge_category')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$pathologyTest->chargecategory->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.pathology_test.standard_charge')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($pathologyTest->standard_charge) }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($pathologyTest->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($pathologyTest->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($pathologyTest->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($pathologyTest->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
