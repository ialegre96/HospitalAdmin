<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.account.account_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a class="btn btn-sm btn-primary edit-btn me-2"
                           data-id="{{ $account->id }}">{{ __('messages.common.edit') }}</a>
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.account.account').(':')  }}</label>
                                <span class="fw-bolder text-gray-800">{{$account->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column text-center">
                                <label class="fw-bold text-muted py-3">{{ __('messages.account.type').(':')  }}</label>
                                <p class="m-0">
                                    <span
                                        class="badge badge-light-{{($account->type == 1) ? 'danger' : 'success'}}">{{ ($account->type == 1) ? 'Debit' : 'Credit' }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 d-flex flex-column text-center">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.status').(':')  }}</label>
                                <p class="m-0">
                                    <span
                                        class="badge badge-light-{{($account->status == 1) ? 'success' : 'danger'}}">{{ ($account->status == 1) ? 'Active' : 'Deactive' }}</span>
                                </p>
                            </div>
                            <div class="col-lg-12 d-flex flex-column mb-2">
                                <label class="fw-bold text-muted py-3">{{ __('messages.account.description')  }}</label>
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ ($account->description != '')? nl2br(e($account->description)):'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.payment.payments') }}</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive viewList">
                        @include('layouts.search-component')
                        <?php
                        $style = 'style=';
                        $maxWidth = 'max-width: 150px';
                        ?>
                        <table id="accountPayments"
                               class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                            <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th>{{ __('messages.payment.payment_date') }}</th>
                                <th>{{ __('messages.payment.description') }}</th>
                                <th>{{ __('messages.payment.pay_to') }}</th>
                                <th class="text-center">{{ __('messages.payment.amount') }}</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold">
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ date('jS M, Y', strtotime($payment->payment_date)) }}</td>
                                    <td class="text-truncate" {{$style}}{{$maxWidth}}>{!! !empty($payment->description)?nl2br(e($payment->description)):'N/A' !!}</td>
                                    <td>{{ $payment->pay_to }}</td>
                                    <td class="text-center">
                                        <b>{{getCurrencySymbol()}}</b> {{ number_format($payment->amount, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
