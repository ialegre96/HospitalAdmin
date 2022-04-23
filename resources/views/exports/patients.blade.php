<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.case.patient') }}</th>
        <th>{{ __('messages.user.email') }}</th>
        <th>{{ __('messages.user.phone') }}</th>
        <th>{{ __('messages.user.gender') }}</th>
        <th>{{ __('messages.user.blood_group') }}</th>
        <th>{{ __('messages.user.dob') }}</th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $patient->user->full_name }}</td>
            <td>{{ $patient->user->email }}</td>
            <td>{{ !empty($patient->user->phone) ? $patient->user->phone : __('messages.common.n/a') }}</td>
            <td>{{ ($patient->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</td>
            <td>{{ !empty($patient->user->blood_group) ? $patient->user->blood_group : __('messages.common.n/a') }}</td>
            <td>{{ !empty($patient->user->dob) ? date('jS M, Y', strtotime($patient->user->dob)) : __('messages.common.n/a') }}</td>
            <td>{{ ($patient->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
