<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.doctor_opd_charge.doctor') }}</th>
        <th>{{ __('messages.doctor_opd_charge.standard_charge') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($doctorOPDCharges as $doctorOPDCharge)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $doctorOPDCharge->doctor->user->full_name }}</td>
            <td>{{ $doctorOPDCharge->standard_charge }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
