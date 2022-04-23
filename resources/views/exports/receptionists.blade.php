<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.user.name') }}</th>
        <th>{{ __('messages.user.email') }}</th>
        <th>{{ __('messages.user.phone') }}</th>
        <th>{{ __('messages.user.designation') }}</th>
        <th>{{ __('messages.user.qualification') }}</th>
        <th>{{ __('messages.user.blood_group') }}</th>
        <th>{{ __('messages.user.gender') }}</th>
        <th>{{ __('messages.user.dob') }}</th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($receptionists as $receptionist)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $receptionist->user->full_name }}</td>
            <td>{{ $receptionist->user->email }}</td>
            <td>{{ !empty($receptionist->user->phone) ? $receptionist->user->phone : __('messages.common.n/a') }}</td>
            <td>{{ $receptionist->user->designation }}</td>
            <td>{{ !empty($receptionist->user->qualification) ? $receptionist->user->qualification : __('messages.common.n/a') }}</td>
            <td>{{ !empty($receptionist->user->blood_group) ? $receptionist->user->blood_group : __('messages.common.n/a') }}</td>
            <td>{{ ($receptionist->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</td>
            <td>{{ !empty($receptionist->user->dob) ? date('jS M, Y', strtotime($receptionist->user->dob)) : __('messages.common.n/a') }}</td>
            <td>{{ ($receptionist->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
