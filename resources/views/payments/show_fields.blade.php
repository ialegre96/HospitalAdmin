<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.payment.payment_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('account', __('messages.account.account').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$payment->account->name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('payment_date', __('messages.payment.payment_date').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($payment->payment_date)->format('jS M, Y')}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('pay_to', __('messages.payment.pay_to').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $payment->pay_to}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('amount', __('messages.payment.amount').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($payment->amount,2) }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($payment->created_at)) }}">{{ $payment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($payment->updated_at)) }}">{{ $payment->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 d-flex flex-column">
                                {{ Form::label('description', __('messages.common.description').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"><b> {!! ($payment->description != '')?nl2br(e($payment->description)):'N/A' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
