<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.schedule.available_on') }}</th>
        <th>{{ __('messages.schedule.available_from') }}</th>
        <th>{{ __('messages.schedule.available_to') }}</th>
        <th>{{ __('messages.schedule.per_patient_time')}}</th>
    </tr>
    </thead>
    <tbody>
    @if($userSchedule != null)
        @foreach($userSchedule->scheduleDays as $schedule)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $schedule->available_on }}</td>
                <td>{{ date('H:i A', strtotime($schedule->available_from)) }}</td>
                <td>{{ date('H:i A', strtotime($schedule->available_to)) }}</td>
                <td>{{ date('H:i', strtotime($schedule->schedule->per_patient_time)) }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
