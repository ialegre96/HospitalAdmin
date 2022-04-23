<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.ambulance.vehicle_number') }}</th>
        <th>{{ __('messages.ambulance.vehicle_model') }}</th>
        <th>{{ __('messages.ambulance.vehicle_type') }}</th>
        <th>{{ __('messages.ambulance.year_made') }}</th>
        <th>{{ __('messages.ambulance.driver_name') }}</th>
        <th>{{ __('messages.ambulance.driver_license') }}</th>
        <th>{{ __('messages.ambulance.driver_contact') }}</th>
        <th>{{ __('messages.ambulance.note') }}</th>
        <th>{{ __('messages.ambulance.is_available') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ambulances as $ambulance)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ambulance->vehicle_number }}</td>
            <td>{{ $ambulance->vehicle_model }}</td>
            <td>{{ $type[$ambulance->vehicle_type] }}</td>
            <td>{{ $ambulance->year_made }}</td>
            <td>{{ $ambulance->driver_name }}</td>
            <td>{{ $ambulance->driver_license }}</td>
            <td>{{ $ambulance->driver_contact }}</td>
            <td>{!! !empty($ambulance->note) ? nl2br(e($ambulance->note)) : __('messages.common.n/a') !!}</td>
            <td>{{ ($ambulance->is_available == 1 )? 'Available' : 'Not available' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
