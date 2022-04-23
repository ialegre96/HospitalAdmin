<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.user.name') }}</th>
        <th>{{ __('messages.user.email') }}</th>
        <th>{{ __('messages.user.phone') }}</th>
        <th>{{ __('messages.user.gender') }}</th>
        <th>{{ __('messages.user.blood_group') }}</th>
        <th>{{ __('messages.user.designation') }}</th>
        <th>{{ __('messages.user.qualification') }}</th>
        <th>{{ __('messages.user.dob') }}</th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pharmacists as $pharmacist)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pharmacist->user->full_name }}</td>
            <td>{{ $pharmacist->user->email }}</td>
            <td>{{ !empty($pharmacist->user->phone) ? $pharmacist->user->phone : __('messages.common.n/a') }}</td>
            <td>{{ ($pharmacist->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</td>
            <td>{{ !empty($pharmacist->user->blood_group) ? $pharmacist->user->blood_group : __('messages.common.n/a') }}</td>
            <td>{{ !empty($pharmacist->user->designation) ? $pharmacist->user->designation : __('messages.common.n/a') }}</td>
            <td>{{ !empty($pharmacist->user->qualification) ? $pharmacist->user->qualification : __('messages.common.n/a') }}</td>
            <td>{{ !empty($pharmacist->user->dob) ? date('jS M, Y', strtotime($pharmacist->user->dob)) : __('messages.common.n/a') }}</td>
            <td>{{ ($pharmacist->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
