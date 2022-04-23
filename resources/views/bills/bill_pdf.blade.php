<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "//www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="{{ asset('web/img/hms-saas-favicon.ico') }}" type="image/png">
    <title>Bill PDF</title>
    <link href="{{ asset('assets/css/bill-pdf.css') }}" rel="stylesheet" type="text/css"/>
    @if(getCurrentCurrency() == 'inr')
        <style>
            body {
                font-family: DejaVu Sans, sans-serif !important;
            }
        </style>
    @endif
</head>
<body>
<table width="100%">
    <tr>
        <td class="header-left">
            <div class="main-heading">{{ __('messages.bill.bill') }}</div>
            <div class="invoice-number font-color-gray">{{ __('messages.bill.admission_id') }}
                #{{ $bill->patient_admission_id }}</div>
        </td>
        <td class="header-right">
            <div class="logo"><img width="100px" src="{{ $setting['app_logo'] }}" alt=""></div>
            <div class="hospital-name">{{ $setting['app_name'] }}</div>
            <div class="hospital-name font-color-gray">{{ $setting['hospital_address'] }}</div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="address">
                <tr>
                    <td colspan="2">
                        <span class="font-weight-bold patient-detail-heading">{{ __('messages.bill.bill_id') }}:</span>
                        #{{ $bill->bill_id }}
                        <br>
                        <span class="font-weight-bold patient-detail-heading">{{ __('messages.bill.bill_date') }}:</span>
                        {{ \Carbon\Carbon::parse($bill->bill_date)->format('jS M,Y g:i A') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2"
                        class="font-weight-bold patient-detail-heading">{{ __('messages.patient.patient_details') }}</td>
                </tr>
                <tr>
                    <td class="patient-details">
                        <table class="patient-detail-one">
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.investigation_report.patient') }}:</td>
                                <td>{{ $bill->patient->user->full_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.user.email') }}:</td>
                                <td>{{ $bill->patient->user->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.bill.cell_no') }}:</td>
                                <td>{{ !empty($bill->patient->user->phone)  ? $bill->patient->user->phone : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.user.gender') }}:</td>
                                <td>{{ $bill->patient->user->gender == 0 ? __('messages.user.male') : __('messages.user.female') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.user.dob') }}:</td>
                                <td>{{ !empty($bill->patient->user->dob) ? Datetime::createFromFormat('Y-m-d',  $bill->patient->user->dob)->format('jS M, Y g:i A') : 'N/A' }}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="patient-detail-two">
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.investigation_report.doctor') }}:</td>
                                <td>{{ $bill->patientAdmission->doctor->user->full_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.bill.admission_date') }}:</td>
                                <td>{{ Datetime::createFromFormat('Y-m-d H:i:s',  $bill->patientAdmission->admission_date)->format('jS M, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.bill.discharge_date') }}:</td>
                                <td>{{ !empty($bill->patientAdmission->discharge_date)?date('jS M, Y g:i A', strtotime($bill->patientAdmission->discharge_date)):'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.package.package') }}:</td>
                                <td>{{ !empty($bill->patientAdmission->package->name)  ? $bill->patientAdmission->package->name  : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.insurance.insurance') }}:</td>
                                <td>{{ !empty($bill->patientAdmission->insurance->name)  ? $bill->patientAdmission->insurance->name : 'N/A' }}</td>
                            </tr>
                            {{--                            <tr>--}}
                            {{--                                <td class="font-weight-bold">{{ __('messages.bill.total_days') }}</td>--}}
                            {{--                                <td>{{ !empty($bill->patient->user->dob) ? Datetime::createFromFormat('Y-m-d',  $bill->patient->user->dob)->format('jS M, Y') : '' }}</td>--}}
                            {{--                            </tr>--}}
                            <tr>
                                <td class="font-weight-bold">{{ __('messages.bill.policy_no') }}:</td>
                                <td>{{ !empty($bill->patientAdmission->policy_no)  ? $bill->patientAdmission->policy_no : 'N/A' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="items-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.bill.item_name') }}</th>
                    <th class="number-align">{{ __('messages.bill.qty') }}</th>
                    <th class="number-align">{{ __('messages.bill.price') }} (<b>{{getCurrencySymbol()}}</b>)
                    </th>
                    <th class="number-align">{{ __('messages.bill.amount') }} (<b>{{getCurrencySymbol()}}</b>)
                    </th>
                </tr>
                </thead>
                <tbody>
                @if(isset($bill) && !empty($bill))
                    @foreach($bill->billItems as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td class="number-align">{{ $item->qty }}</td>
                            <td class="number-align">{{ number_format($item->price, 2) }}</td>
                                <td class="number-align">{{ number_format($item->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <table class="bill-footer">
                <tr>
                    <td class="font-weight-bold">{{ __('messages.bill.total_amount').(':') }}</td>
                    <td><b>{{getCurrencySymbol()}} </b> {{ number_format($bill->amount,2) }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
