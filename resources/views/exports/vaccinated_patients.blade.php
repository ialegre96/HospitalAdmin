<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.vaccinated_patient.patient') }}</th>
        <th>{{ __('messages.vaccinated_patient.vaccine') }}</th>
        <th>{{ __('messages.vaccinated_patient.serial_no') }}</th>
        <th>{{ __('messages.vaccinated_patient.does_no') }}</th>
        <th>{{ __('messages.vaccinated_patient.dose_given_date') }}</th>
        <th>{{ __('messages.vaccinated_patient.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vaccinatedPatients as $vaccinatedPatient)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $vaccinatedPatient->patient->user->full_name }}</td>
            <td>{{ $vaccinatedPatient->vaccination->name }}</td>
            <td>{{ $vaccinatedPatient->vaccination_serial_number }}</td>
            <td>{{ $vaccinatedPatient->dose_number }}</td>
            <td>{{ $vaccinatedPatient->dose_given_date }}</td>
            <td>{{ $vaccinatedPatient->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
