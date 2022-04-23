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
    @foreach($labTechnicians as $labTechnician)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $labTechnician->user->full_name }}</td>
            <td>{{ $labTechnician->user->email }}</td>
            <td>{{ !empty($labTechnician->user->phone) ? $labTechnician->user->phone : __('messages.common.n/a') }}</td>
            <td>{{ $labTechnician->user->designation }}</td>
            <td>{{ !empty($labTechnician->user->qualification) ? $labTechnician->user->qualification : __('messages.common.n/a') }}</td>
            <td>{{ !empty($labTechnician->user->blood_group) ? $labTechnician->user->blood_group : __('messages.common.n/a') }}</td>
            <td>{{ ($labTechnician->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</td>
            <td>{{ !empty($labTechnician->user->dob) ? date('jS M, Y', strtotime($labTechnician->user->dob)) : __('messages.common.n/a') }}</td>
            <td>{{ ($labTechnician->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
