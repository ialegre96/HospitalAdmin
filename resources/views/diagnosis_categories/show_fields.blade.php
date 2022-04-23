<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.diagnosis_category.diagnosis_category')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a data-id="{{ $diagnosisCategory->id }}"
                           class="btn btn-sm btn-primary me-2 edit-btn">{{ __('messages.common.edit') }}</a>
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.diagnosis_category.diagnosis_category')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $diagnosisCategory->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column text-center">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($diagnosisCategory->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($diagnosisCategory->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column text-center">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($diagnosisCategory->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($diagnosisCategory->updated_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.diagnosis_category.description')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"> {!! !empty($diagnosisCategory->description)? nl2br(e($diagnosisCategory->description)):'N/A' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
