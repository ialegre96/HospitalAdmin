<div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
    <div class="mt-n1">
        <div class="d-flex flex-stack pb-10">
            <img alt="Logo" src="{{ getLogoUrl() }}" height="100px" width="100px">
            <a target="_blank" href="{{ route('bills.pdf',['bill' => $bill->id]) }}" class="btn btn-sm btn-success">{{ __('messages.bill.print_bill') }}</a>
        </div>
        <div class="m-0">
            <div class="fw-bolder fs-3 text-gray-800 mb-8">Bill #{{ $bill->bill_id }}</div>
            <div class="row g-5 mb-11">
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.case.patient').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ $bill->patient->user->full_name }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.bill_date').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ Carbon\Carbon::parse($bill->bill_date)->format('jS M, Y g:i A') }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.admission_id').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ $bill->patientAdmission->patient_admission_id }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.patient_email').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ $bill->patient->user->email }}</div>
                </div>
            </div>
            <div class="row g-5 mb-11">
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.patient_cell_no').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ !empty($bill->patient->user->phone) ? $bill->patient->user->phone : __('messages.common.n/a') }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.patient_gender').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ (!$bill->patient->user->gender) ? __('messages.user.male') : __('messages.user.female') }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.patient_dob').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ (!empty($bill->patient->user->dob)) ? \Carbon\Carbon::parse($bill->patient->user->dob)->format('jS M, Y') : __('messages.common.n/a') }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.case.doctor').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ $bill->patientAdmission->doctor->user->full_name }}</div>
                </div>
            </div>
            <div class="row g-5 mb-11">
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.admission_date').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($bill->patientAdmission->admission_date)->format('jS M, Y g:i A') }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.discharge_date').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ !empty($bill->patientAdmission->discharge_date)?date('jS M, Y g:i A', strtotime($bill->patientAdmission->discharge_date)):'N/A' }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.package_name').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ !empty($bill->patientAdmission->package->name)?$bill->patientAdmission->package->name:'N/A' }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.insurance_name').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ !empty($bill->patientAdmission->insurance->name)?$bill->patientAdmission->insurance->name:'N/A' }}</div>
                </div>
            </div>
            <div class="row g-5 mb-11">
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.total_days').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ $bill->totalDays }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.bill.policy_no').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ !empty($bill->patientAdmission->policy_no) ? $bill->patientAdmission->policy_no : __('messages.common.n/a') }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.common.created_on').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ $bill->created_at->diffForHumans() }}</div>
                </div>
                <div class="col-sm-3">
                    <div class="fw-bold fs-7 text-gray-600 mb-1">{{ __('messages.common.last_updated').':' }}</div>
                    <div class="fw-bolder fs-6 text-gray-800">{{ $bill->created_at->diffForHumans() }}</div>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="table-responsive border-bottom mb-9">
                    <table class="table mb-3">
                        <thead>
                        <tr class="border-bottom fs-6 fw-bolder text-muted">
                            <th class="min-w-175px pb-2">{{ __('messages.bill.item_name') }}</th>
                            <th class="min-w-70px text-end pb-2">{{ __('messages.bill.qty') }}</th>
                            <th class="min-w-70px text-end pb-2">{{ __('messages.bill.price') }}</th>
                            <th class="min-w-80px text-end pb-2">{{ __('messages.bill.amount') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bill->billItems as $index => $billItem)
                            <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                <td class="d-flex align-items-center pt-6">{{ $billItem->item_name }}</td>
                                <td class="pt-6">{{ $billItem->qty }}</td>
                                <td class="pt-6"><b>{{ getCurrencySymbol() }}</b> {{ number_format($billItem->price) }}</td>
                                <td class="pt-6 text-dark fw-boldest">
                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($billItem->amount) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="mw-300px">
                        <div class="d-flex flex-stack">
                            <div class="fw-bold pe-10 text-gray-600 fs-7">{{ __('messages.bill.total_amount').(':') }}</div>
                            <div class="text-end fw-bolder fs-6 text-gray-800">{{ getCurrencySymbol()}}  {{ number_format($bill->amount,2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
