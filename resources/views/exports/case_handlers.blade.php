<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.common.name') }}</th>
        <th>{{ __('messages.user.email') }}</th>
        <th>{{ __('messages.user.phone') }}</th>
        <th>{{ __('messages.user.designation') }}</th>
        <th>{{ __('messages.user.qualification') }}</th>
        <th>{{ __('messages.user.gender') }}</th>
        <th>{{ __('messages.user.blood_group') }}</th>
        <th>{{ __('messages.user.dob') }}</th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($caseHandlers as $caseHandler)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $caseHandler->user->full_name }}</td>
            <td>{{ $caseHandler->user->email }}</td>
            <td>{{ !empty($caseHandler->user->phone) ? $caseHandler->user->phone : __('messages.common.n/a') }}</td>
            <td>{{ $caseHandler->user->designation }}</td>
            <td>{{ !empty($caseHandler->user->qualification) ? $caseHandler->user->qualification : __('messages.common.n/a') }}</td>
            <td>{{ ($caseHandler->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</td>
            <td>{{ !empty($caseHandler->user->blood_group) ? $caseHandler->user->blood_group : __('messages.common.n/a') }}</td>
            <td>{{ !empty($caseHandler->user->dob) ? date('jS M, Y', strtotime($caseHandler->user->dob)) : __('messages.common.n/a') }}</td>
            <td>{{ ($caseHandler->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
