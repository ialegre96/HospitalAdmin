<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.insurance.insurance') }}</th>
        <th>{{ __('messages.insurance.service_tax') }}</th>
        <th>{{ __('messages.insurance.discount') }}</th>
        <th>{{ __('messages.insurance.insurance_no') }}</th>
        <th>{{ __('messages.insurance.insurance_code') }}</th>
        <th>{{ __('messages.insurance.hospital_rate') }}</th>
        <th>{{ __('messages.common.total') }}</th>
        <th>{{ __('messages.common.status') }}</th>
        <th>{{ __('messages.insurance.remark') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($insurances as $insurance)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $insurance->name }}</td>
            <td>{{ number_format($insurance->service_tax, 2) }}</td>
            <td>{{ isset($insurance->discount) ? $insurance->discount.'%' : __('messages.common.n/a') }}</td>
            <td>{{ $insurance->insurance_no }}</td>
            <td>{{ $insurance->insurance_code }}</td>
            <td>{{ number_format($insurance->hospital_rate, 2) }}</td>
            <td>{{ number_format($insurance->total, 2) }}</td>
            <td>{{ ($insurance->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
            <td>{!! !empty($insurance->remark) ? nl2br(e($insurance->remark)) : __('messages.common.n/a') !!}</td>
        </tr>
        <tr></tr>
        <tr>
            <td>
                <table>
                    <thead>
                    <tr>
                        <th>{{ __('messages.common.no') }}</th>
                        <th>{{ __('messages.insurance.diseases_name') }}</th>
                        <th>{{ __('messages.insurance.diseases_charge') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($insurance->insuranceDiseases as $insuranceDisease)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $insuranceDisease->disease_name }}</td>
                            <td>{{ number_format($insuranceDisease->disease_charge, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
