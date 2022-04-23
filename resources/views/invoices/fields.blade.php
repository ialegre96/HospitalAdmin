<div class="container-xxl">
    <div class="d-flex flex-column align-items-start flex-xxl-row">
        <div class="d-flex align-items-center flex-equal fw-row me-4 order-2">
            <div class="">
                {{ Form::label('patient_id', __('messages.invoice.patient').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::select('patient_id', $patients, isset($invoice) ? $invoice->patient_id : null, ['class' => 'form-select form-select-solid fw-select', 'id' => 'patient_id', 'placeholder' => 'Select Patient','required','data-control' =>'select2']) }}
            </div>
        </div>

        <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="invoice number">
            <span class="fs-2x fw-bolder text-gray-800">Invoice #</span>
            <span class="form-control-flush fw-bolder text-muted fs-3 w-125px">{{ $invoiceId = (isset($invoice) ? $invoice->invoice_id : \App\Models\Invoice::generateUniqueInvoiceId()) }}</span>
            @if(!isset($invoice))
                <input type="hidden" value="{{ $invoiceId }}" name="invoice_id"/>
            @endif
        </div>

        <div class="d-flex align-items-center justify-content-end flex-equal order-3 fw-row">
            @if(isset($invoice))
                <div class="">
                    {{ Form::label('invoice_date', __('messages.invoice.invoice_date').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('invoice_date', null, ['class' => 'form-control form-control-solid', 'id' => 'editInvoiceDate', 'autocomplete' => 'off','required']) }}
                </div>
            @else
                <div class="">
                    {{ Form::label('invoice_date', __('messages.invoice.invoice_date').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('invoice_date', null, ['class' => 'form-control form-control-solid', 'id' => 'invoice_date', 'autocomplete' => 'off','required']) }}
                </div>
            @endif
        </div>
    </div>

    <div class="separator separator-dashed my-10"></div>
    <div class="mb-0">
        <div class="row gx-10 mb-5">
            <div class="col-lg-6 col-sm-12">
                <div class="mb-5">
                    {{ Form::label('discount', __('messages.invoice.discount').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    (%)
                    {{ Form::number('discount',  isset($invoice) ? $invoice->discount : null, ['id'=>'discount','class' => 'form-control form-control-solid','placeholder' => 'In percentage','required', 'min' => 0, 'max' => 100, 'step' => '.01']) }}
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="mb-5">
                    {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::select('status', $statusArr, isset($invoice) ? $invoice->status : null, ['class' => 'form-select form-select-solid fw-bold', 'id' => 'status','required','data-control' => 'select2']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
            <button type="button" class="btn btn-sm btn-primary text-start" id="addItem"> {{ __('messages.invoice.add') }}</button>
        </div>
        <div class="table-responsive">
            <table class="table g-5 gs-0 mb-0 fw-bolder text-gray-700" id="billTbl">
                <thead>
                    <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                        <th class="min-w-50px w-50px text-center">#</th>
                        <th class="min-w-300px w-475px">{{ __('messages.account.account') }}</th>
                        <th class="min-w-300px w-475px">{{ __('messages.invoice.description') }}</th>
                        <th class="min-w-100px w-100px required">{{ __('messages.invoice.qty') }}</th>
                        <th class="min-w-150px w-150px required">{{ __('messages.invoice.price') }}</th>
                        <th class="min-w-100px w-150px text-end required">{{ __('messages.invoice.amount') }}</th>
                        <th class="min-w-75px w-75px text-end">{{ __('messages.common.action') }}</th>
                    </tr>
                </thead>
                <tbody class="invoice-item-container">
                @if(isset($invoice))
                    @foreach($invoice->invoiceItems as $invoiceItem)
                        <tr class="border-bottom border-bottom-dashed">
                            <td class="text-center item-number">1</td>
                            <td class="table__item-desc">
                                {{ Form::select('account_id[]', $accounts, $invoiceItem->account_id, ['class' => 'form-select accountId form-select-solid fw-bold', 'required', 'placeholder'=>'Select Account', 'data-control' => 'select2']) }}
                                {{ Form::hidden('id[]', $invoiceItem->id) }}
                            </td>
                            <td>
                                {{ Form::text('description[]', $invoiceItem->description, ['class' => 'form-control form-control-solid']) }}
                            </td>
                            <td class="table__qty">
                                {{ Form::number('quantity[]', $invoiceItem->quantity, ['class' => 'form-control qty form-control-solid','required', 'type' => 'number', "min" => 1]) }}
                            </td>
                            <td>
                                {{ Form::text('price[]', number_format($invoiceItem->price), ['class' => 'form-control price-input price form-control-solid','required']) }}
                            </td>
                            <td class="amount text-end item-total pt-8 text-nowrap">
                                <i class="{{getCurrenciesClass()}} text-dark"></i> {{ number_format($invoiceItem->total) }}
                            </td>
                            <td class="text-end">
                                <button type="button" title="{{ __('messages.common.delete') }}"
                                        class="btn btn-sm btn-icon btn-active-color-danger delete-invoice-item">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path
                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                    fill="black"></path>
                                            <path opacity="0.5"
                                                  d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                  fill="black"></path>
                                            <path opacity="0.5"
                                                  d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                  fill="black"></path>
                                        </svg>
                                    </span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-bottom border-bottom-dashed">
                        <td class="text-center item-number">1</td>
                        <td class="table__item-desc">
                            {{ Form::select('account_id[]', $accounts, null, ['class' => 'form-select accountId form-select-solid fw-bold','required','placeholder'=>'Select Account','data-control' => 'select2']) }}
                        </td>
                        <td>
                            {{ Form::text('description[]', null, ['class' => 'form-control form-control-solid']) }}
                        </td>
                        <td class="table__qty">
                            {{ Form::number('quantity[]', null, ['class' => 'form-control qty form-control-solid','required', 'type' => 'number', "min" => 1]) }}
                        </td>
                        <td>
                            {{ Form::text('price[]', null, ['class' => 'form-control price-input price form-control-solid','required']) }}
                        </td>
                        <td class="amount text-end item-total pt-8 text-nowrap">
                            0.00
                        </td>
                        <td class="text-end">
                            <button type="button" title="{{ __('messages.common.delete') }}"
                                    class="btn btn-sm btn-icon btn-active-color-danger delete-invoice-item">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                fill="black"></path>
                                            <path opacity="0.5"
                                                  d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                  fill="black"></path>
                                            <path opacity="0.5"
                                                  d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                  fill="black"></path>
                                        </svg>
                                    </span>
                            </button>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="separator separator-dashed"></div>
        <div class="row justify-content-end">
            <div class="col-lg-4 col-md-4 col-sm-6 end justify-content-end">
                <table class="table table-responsive-sm table-row-dashed g-5 gs-0 mb-0 fw-bolder text-gray-700 mr-3">
                    <tbody>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <td class="font-weight-bold fw-bolder text-gray-800">{{ __('messages.invoice.sub_total').(':') }}</td>
                            <td class="font-weight-bold fw-bolder text-gray-800 text-end">
                                <span>{{ getCurrencySymbol() }}</span> <span id="total" class="price">
                                    {{ isset($invoice) ? number_format($invoice->amount,2) : 0 }}
                                </span>
                            </td>
                        </tr>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <td class="font-weight-bold fw-bolder text-gray-800">{{ __('messages.invoice.discount').(':') }}</td>
                            <td class="font-weight-bold fw-bolder text-gray-800 text-end">
                                <span>{{ getCurrencySymbol() }}</span> <span id="discountAmount">
                                    {{ isset($invoice) ? number_format($invoice->amount * $invoice->discount / 100,2) : 0 }}
                                </span>
                            </td>
                        </tr>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <td class="font-weight-bold fw-bolder text-gray-800">{{ __('messages.invoice.total').(':') }}</td>
                            <td class="font-weight-bold fw-bolder text-gray-800 text-end">
                                <span>{{ getCurrencySymbol() }}</span> <span id="finalAmount">
                                    {{ isset($invoice) ? number_format($invoice->amount - ($invoice->amount * $invoice->discount / 100),2) : 0 }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Total Amount Field -->
{{ Form::hidden('amount', isset($invoice) ? number_format($invoice->amount - ($invoice->amount * $invoice->discount / 100),2) : 0, ['class' => 'form-control', 'id' => 'total_amount']) }}

<!-- Submit Field -->
<div class=" d-flex">
{{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) }}
<a href="{{ route('invoices.index') }}"
   class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
