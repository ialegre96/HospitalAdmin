<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.case.doctor') }}</th>
        <th>{{ __('messages.user.email') }}</th>
        <th>{{ __('messages.user.phone') }}</th>
        <th>{{ __('messages.user.designation') }}</th>
        <th>{{ __('messages.appointment.doctor_department') }}</th>
        <th>{{ __('messages.user.qualification') }}</th>
        <th>{{ __('messages.user.blood_group') }}</th>
        <th>{{ __('messages.user.dob') }}</th>
        <th>{{ __('messages.doctor.specialist') }}</th>
        <th>{{ __('messages.user.gender') }}</th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($doctors as $doctor)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $doctor->user->full_name }}</td>
            <td>{{ $doctor->user->email }}</td>
            <td>{{ !empty($doctor->user->phone) ? $doctor->user->phone : __('messages.common.n/a') }}</td>
            <td>{{ $doctor->user->designation ?? __('messages.common.n/a') }}</td>
            <td>{{ getDoctorDepartment($doctor->doctor_department_id) }}</td>
            <td>{{ $doctor->user->qualification ?? __('messages.common.n/a') }}</td>
            <td>{{ !empty($doctor->user->blood_group) ? $doctor->user->blood_group : __('messages.common.n/a') }}</td>
            <td>{{ !empty($doctor->user->dob) ? date('jS M, Y', strtotime($doctor->user->dob)) : __('messages.common.n/a') }}</td>
            <td>{{ $doctor->specialist ?? __('messages.common.n/a') }}</td>
            <td>{{ ($doctor->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</td>
            <td>{{ ($doctor->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
