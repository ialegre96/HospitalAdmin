<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.operation_report.case_id') }}</th>
        <th>{{ __('messages.case.patient') }}</th>
        <th>{{ __('messages.case.phone') }}</th>
        <th>{{ __('messages.case.doctor') }}</th>
        <th>{{ __('messages.case.case_date') }}</th>
        <th>{{ __('messages.common.status') }}</th>
        <th>{{ __('messages.case.fee') }}</th>
        <th>{{ __('messages.common.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($patientCases as $patientCase)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $patientCase->case_id }}</td>
            <td>{{ $patientCase->patient->user->full_name }}</td>
            <td>{{ !empty($patientCase->phone) ? $patientCase->phone : __('messages.common.n/a') }}</td>
            <td>{{ $patientCase->doctor->user->full_name }}</td>
            <td>{{ date('jS M, Y g:i A', strtotime($patientCase->date)) }}</td>
            <td>{{ ($patientCase->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
            <td>{{ number_format($patientCase->fee, 2) }}</td>
            <td>{!! !empty($patientCase->description) ? nl2br(e($patientCase->description)) : __('messages.common.n/a') !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
