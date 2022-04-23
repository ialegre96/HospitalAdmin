<div class="row">
    <div class="col-lg-6 col-md-12">
        <h5>{{ __('messages.ipd_charges') }}</h5>
        <div class="table-responsive-sm">
            <table class="table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gx-5 gy-5 dataTable no-footer w-100">
                <thead class="thead-light">
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th scope="col">{{ __('messages.account.type') }}</th>
                    <th scope="col">{{ __('messages.medicine.category') }}</th>
                    <th scope="col">{{ __('messages.ipd_patient_charges.date') }}</th>
                    <th scope="col" class="text-right">{{ __('messages.invoice.amount') }}</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach($bill['charges'] as $charge)
                    <tr>
                        <td>{{ $charge->charge_type }}</td>
                        <td>{{ $charge->chargecategory->name }}</td>
                        <td>{{ $charge->date->format('d/m/Y') }}</td>
                        <td class="text-right">{{ number_format($charge->applied_charge) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td class="text-right" colspan="4">
                        {{ __('messages.bill.total_amount').':' }}
                        <span class="pl-2 font-weight-bold"><i class="{{ getCurrenciesClass() }}"></i>
                            <span>{{ $bill['total_charges']  }}</span></span>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <h5>{{ __('messages.account.payments') }}</h5>
        <div class="table-responsive-sm">
            <table class="table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gx-5 gy-5 dataTable no-footer w-100">
                <thead class="thead-light">
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th scope="col">{{ __('messages.ipd_payments.payment_mode') }}</th>
                    <th scope="col">{{ __('messages.ipd_patient_charges.date') }}</th>
                    <th scope="col" class="text-right">{{ __('messages.ipd_bill.paid_amount') }}</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach($bill['payments'] as $payment)
                    <tr>
                        <td>{{ $payment->payment_mode_name }}</td>
                        <td>{{ $payment->date->format('d/m/Y') }}</td>
                        <td class="text-right">{{ number_format($payment->amount) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td class="text-right" colspan="4">
                        {{ __('messages.bill.total_amount').':' }}
                        <span class="pl-2 font-weight-bold"><i class="{{ getCurrenciesClass() }}"></i>
                            <span>{{ $bill['total_payment']  }}</span>
                        </span>
                    </td>
                </tr>
                </tfoot>
            </table>

        </div>
        <form id="ipdBillForm">
            <input type="hidden" value="{{ $ipdPatientDepartment->id }}" name="ipd_patient_department_id">
            @if($ipdPatientDepartment->bill)
                <input type="hidden" value="{{ $ipdPatientDepartment->bill->id }}" name="bill_id">
            @endif
            <div class="row mb-5">
                <div class="col-lg-12 col-md-12 table-responsive-sm">
                    <table class="table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gx-5 gy-5 dataTable no-footer w-100">
                        <thead class="thead-light">
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="h5 font-weight-bold" scope="col"
                                colspan="2">{{ __('messages.bill.bill_summary') }}</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">

                        <tr>
                            <td>{{ __('messages.ipd_bill.paid_amount').':' }}</td>
                            <td class="text-right font-weight-bold"><i class="{{ getCurrenciesClass() }}"></i> <span
                                        id="totalPayments">{{ $bill['total_payment']  }}</span>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.total_charges').':' }}</td>
                            <td class="text-right font-weight-bold"><i class="{{ getCurrenciesClass() }}"></i> <span
                                        id="totalCharges">{{ $bill['total_charges']  }}</span>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.gross_total').':' }}</td>
                            <td class="text-right font-weight-bold"><i class="{{ getCurrenciesClass() }}"></i> <span
                                        id="grossTotal">{{ $bill['gross_total']  }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.discount_in_percentage').' (%) :' }}</td>
                            <td class="text-right font-weight-bold">
                                <div class="input-group w-25 w-sm-50 w-xs-75 float-right ">
                                    <input type="text" class="form-control form-control-solid text-right price-input"
                                           name="discount_in_percentage" id="discountPercent"
                                           value="{{ $bill['discount_in_percentage'] }}" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.tax_in_percentage').' (%) :' }}</td>
                            <td class="text-right font-weight-bold">
                                <div class="input-group w-25 w-sm-50 w-xs-75 float-right ">
                                    <input type="text" name="tax_in_percentage" id="taxPercentage"
                                           class="form-control text-right price-input"
                                           value="{{ $bill['tax_in_percentage'] }}" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.other_charges').':' }}</td>
                            <td class="text-right font-weight-bold">
                                <div class="input-group w-25 w-sm-50 w-xs-75 float-right ">
                                    <input type="text" class="form-control form-control-solid price-input" name="other_charges"
                                           id="otherCharges"
                                           value="{{ $bill['other_charges'] }}" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">{{ __('messages.ipd_bill.net_payable_amount').':' }}
                                (<span id="billStatus"></span>)
                            </td>
                            <td class="text-right font-weight-bold"><i class="{{ getCurrenciesClass() }}"></i>
                                <span id="netPayabelAmount">{{ $bill['net_payable_amount']  }}</span></td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
            <a href="{{ url('ipd-bills/'.$ipdPatientDepartment->id.'/pdf') }}" target="_blank"
               class="btn btn-light mb-5 btn-active-light-primary me-2 {{ ($ipdPatientDepartment->bill) ? '' : 'disabled' }} "
               id="printBillBtn" role="button" aria-pressed="true">{{ __('messages.bill.print_bill')  }}</a>
            @if(!$ipdPatientDepartment->bill_status)
                <button type="submit" class="btn mb-5 btn-light btn-active-light-primary me-2" id="saveIpdBillbtn">
                    {{  __('messages.bill.generate_bill'). ' & ' . __('messages.ipd_bill.discharge_patient') }}
                </button>
            @endif


        </form>
    </div>
</div>
