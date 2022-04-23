<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.incomes.income_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.incomes.name')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$incomes->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.incomes.income_head')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$incomeHeads[$incomes->income_head]}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.incomes.invoice_number')  }}</label>
                                <p class="m-0">
                                    <span class="badge badge-light-info fs-6">{{ !empty($incomes->invoice_number)?$incomes->invoice_number:'N/A' }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.incomes.date')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ date('jS M, Y', strtotime($incomes->date))}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.incomes.amount')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($incomes->amount, 2) }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.incomes.attachment')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">
                                @if(!empty($incomes->document_url))
                                        <a href="{{$incomes->document_url}}" target="_blank">View</a>
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.incomes.description')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"> {!! !empty($incomes->description) ? nl2br(e($incomes->description)) : 'N/A' !!}
                                </span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right"
                                      title="{{ \Carbon\Carbon::parse($incomes->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($incomes->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right"
                                      title="{{ \Carbon\Carbon::parse($incomes->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($incomes->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
