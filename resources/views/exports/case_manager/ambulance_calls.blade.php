<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.ambulance_call.patient') }}</th>
        <th>{{ __('messages.ambulance_call.vehicle_model') }}</th>
        <th>{{ __('messages.ambulance_call.date') }}</th>
        <th>{{ __('messages.ambulance_call.driver_name') }}</th>
        <th>{{ __('messages.ambulance_call.amount') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ambulanceCalls as $ambulanceCall)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ambulanceCall->patient->user->full_name }}</td>
            <td>{{ $ambulanceCall->ambulance->vehicle_model }}</td>
            <td>{{ date('jS M, Y', strtotime($ambulanceCall->date)) }}</td>
            <td>{{ $ambulanceCall->driver_name }}</td>
            <td>{{ number_format($ambulanceCall->amount,2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
