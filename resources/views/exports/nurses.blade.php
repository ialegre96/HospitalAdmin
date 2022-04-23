<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.common.name') }}</th>
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
    @foreach($nurses as $nurse)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $nurse->user->full_name }}</td>
            <td>{{ $nurse->user->email }}</td>
            <td>{{ !empty($nurse->user->phone) ? $nurse->user->phone : __('messages.common.n/a') }}</td>
            <td>{{ $nurse->user->designation }}</td>
            <td>{{ !empty($nurse->user->qualification) ? $nurse->user->qualification : __('messages.common.n/a') }}</td>
            <td>{{ !empty($nurse->user->blood_group) ? $nurse->user->blood_group : __('messages.common.n/a') }}</td>
            <td>{{ ($nurse->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</td>
            <td>{{ !empty($nurse->user->dob) ? date('jS M, Y', strtotime($nurse->user->dob)) : __('messages.common.n/a') }}</td>
            <td>{{ ($nurse->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
