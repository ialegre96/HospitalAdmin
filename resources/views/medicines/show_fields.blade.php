<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.medicine.medicine_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.medicine')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$medicine->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.brand')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$medicine->brand->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.category')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$medicine->category->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.salt_composition')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$medicine->salt_composition}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.selling_price')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ getCurrencySymbol() }}</b> {{ number_format($medicine->selling_price, 2) }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.buying_price')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($medicine->buying_price, 2) }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.side_effects')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($medicine->side_effects)?nl2br(e($medicine->side_effects)):'N/A'  !!}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($medicine->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($medicine->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($medicine->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($medicine->updated_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.description')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($medicine->description)?nl2br(e($medicine->description)):'N/A' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
