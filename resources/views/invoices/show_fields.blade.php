<div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
    <div class="mt-n1">
        <div class="d-flex flex-stack pb-10">
            <img alt="Logo" src="{{ getLogoUrl() }}" height="100px" width="100px">
            <a target="_blank" href="{{ route('invoices.pdf',['invoice' => $invoice->id]) }}"
               class="btn btn-sm btn-success">{{ __('messages.invoice.print_invoice') }}</a>
        </div>
        <div class="m-0">
            <div class="fw-bolder fs-3 text-gray-800 mb-8">Invoice #{{ $invoice->invoice_id }}</div>
            <div class="row g-5 mb-11">
                <div class="col-sm-6">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.invoice.invoice_date').':' }}</div>
                    <div
                        class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('jS M, Y') }}</div>
                </div>
            </div>
            <div class="row g-5 mb-12">
                <div class="col-sm-6">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">Issue For:</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ $invoice->patient->user->full_name }}</div>
                    <div class="fw-bold fs-7 text-gray-600">@if(isset($invoice->patient->address) && !empty($invoice->patient->address))
                            {{ ucfirst($invoice->patient->address->address1) .' '. ucfirst($invoice->patient->address->address2) .', ' . ucfirst($invoice->patient->address->city) .' '. $invoice->patient->address->zip }}
                        @else
                            {{ "N/A" }}
                        @endif</div>
                </div>
                <div class="col-sm-6">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">Issued By:</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ getAppName() }}</div>
                    <div class="fw-bold fs-7 text-gray-600">{{ ($hospitalAddress=="") ? __('messages.common.n/a') : $hospitalAddress }}</div>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="table-responsive border-bottom mb-9">
                    <table class="table mb-3">
                        <thead>
                        <tr class="border-bottom fs-6 fw-bolder text-muted">
                            <th class="min-w-175px pb-2">{{ __('messages.account.account') }}</th>
                            <th class="min-w-70px text-end pb-2">{{ __('messages.invoice.description') }}</th>
                            <th class="min-w-70px text-end pb-2">{{ __('messages.invoice.qty') }}</th>
                            <th class="min-w-80px text-end pb-2">{{ __('messages.invoice.price') }}</th>
                            <th class="min-w-100px text-end pb-2">{{ __('messages.invoice.amount') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->invoiceItems as $index => $invoiceItem)
                            <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                <td class="d-flex align-items-center pt-6">{{ $invoiceItem->account->name }}</td>
                                <td class="pt-6">{!! ($invoiceItem->description != '')?nl2br(e($invoiceItem->description)):'N/A' !!}</td>
                                <td class="pt-6">{{ $invoiceItem->quantity }}</td>
                                <td class="pt-6"><b>{{ getCurrencySymbol() }}</b> {{ number_format($invoiceItem->price) }}</td>
                                <td class="pt-6 text-dark fw-boldest">
                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($invoiceItem->total) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="mw-300px">
                        <div class="d-flex flex-stack mb-3">
                            <div class="fw-bold pe-10 text-gray-600 fs-7">{{ __('messages.invoice.sub_total').(':') }}</div>
                            <div class="text-end fw-bolder fs-6 text-gray-800">{{ getCurrencySymbol() }} {{ number_format($invoice->amount,2) }}</div>
                        </div>
                        <div class="d-flex flex-stack mb-3">
                            <div class="fw-bold pe-10 text-gray-600 fs-7">{{ __('messages.invoice.discount').(':') }}</div>
                            <div class="text-end fw-bolder fs-6 text-gray-800">{{ getCurrencySymbol() }} {{ number_format(($invoice->amount * $invoice->discount / 100),2) }}</div>
                        </div>
                        <div class="d-flex flex-stack">
                            <div class="fw-bold pe-10 text-gray-600 fs-7">{{ __('messages.invoice.total').(':') }}</div>
                            <div class="text-end fw-bolder fs-6 text-gray-800">{{ getCurrencySymbol() }} {{ number_format($invoice->amount - ($invoice->amount * $invoice->discount / 100),2)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-0">
    <div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
        <div class="mb-8">
            @if($invoice->status == \App\Models\Invoice::PENDING)
                <span class="badge badge-light-warning">Pending Payment</span>
            @elseif($invoice->status == \App\Models\Invoice::PAID)
                <span class="badge badge-light-success me-2">Paid</span>
            @endif
        </div>
        <h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">PATIENT OVERVIEW</h6>
        <div class="mb-6">
            <div class="fw-bold text-gray-600 fs-7">{{ __('messages.death_report.patient_name') }}</div>
            <div class="fw-bolder fs-6 text-gray-800">
                <a href="{{ route('patients.show', ['patient' => $invoice->patient->id]) }}" class="link-primary">{{ $invoice->patient->user->full_name }}</a></div>
        </div>
        <div class="mb-6">
            <div class="fw-bold text-gray-600 fs-7">{{ __('messages.bill.patient_email') }}</div>
            <div class="fw-bolder text-gray-800 fs-6">{{ $invoice->patient->user->email }}</div>
        </div>
        <div class="mb-6">
            <div class="fw-bold text-gray-600 fs-7">{{ __('messages.bill.patient_gender') }}</div>
            <div class="fw-bolder text-gray-800 fs-6">{{ $invoice->patient->user->gender == 1 ? __('messages.user.female'): __('messages.user.male') }}</div>
        </div>
    </div>
</div>
