<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.case.patient') }}</th>
        <th>{{ __('messages.case.doctor') }}</th>
        <th>{{ __('messages.appointment.doctor_department') }}</th>
        <th>{{ __('messages.appointment.description') }}</th>
        <th>{{ __('messages.appointment.date') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($appointments as $appointment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $appointment->patient->user->full_name }}</td>
            <td>{{ $appointment->doctor->user->full_name }}</td>
            <td>{{ $appointment->doctor->department->title }}</td>
            <td>{!! !empty($appointment->problem) ? nl2br(e($appointment->problem)) : __('messages.common.n/a')  !!}</td>
            <td>{{ !empty($appointment->opd_date) ? date('jS M, Y g:i A', strtotime($appointment->opd_date)) : __('messages.common.n/a') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
