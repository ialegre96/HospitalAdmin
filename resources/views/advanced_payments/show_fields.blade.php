<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.advanced_payment.advanced_payment_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a class="btn btn btn-sm btn-primary me-2 edit-btn"
                           data-id="{{ $advancedPayment->id }}">{{ __('messages.common.edit') }}</a>
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('patient', __('messages.case.patient').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ $advancedPayment->patient->user->full_name }}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('receipt no', __('messages.advanced_payment.receipt_no').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0">
                                    <span class="badge badge-light-info fs-6 ">{{ $advancedPayment->receipt_no}}</span>
                                </p>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('amount', __('messages.advanced_payment.amount').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ number_format($advancedPayment->amount, 2)}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('date', __('messages.advanced_payment.date').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($advancedPayment->date)->format('jS M, Y') }}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created at', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"  title="{{ date('jS M, Y', strtotime($advancedPayment->created_at)) }}">{{ $advancedPayment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"  title="{{ date('jS M, Y', strtotime($advancedPayment->updated_at)) }}">{{ $advancedPayment->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
