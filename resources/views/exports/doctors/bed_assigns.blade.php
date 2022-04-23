<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.case.patient') }}</th>
        <th>{{ __('messages.bed_assign.bed') }}</th>
        <th>{{ __('messages.bed_assign.case_id') }}</th>
        <th>{{ __('messages.bed_assign.assign_date') }}</th>
        <th>{{ __('messages.bed_assign.discharge_date') }}</th>
        <th>{{ __('messages.bed_assign.description') }}</th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bedAssigns as $bedAssign)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bedAssign->patient->user->full_name }}</td>
            <td>{{ $bedAssign->bed->name }}</td>
            <td>{{ $bedAssign->case_id }}</td>
            <td>{{ date('jS M,Y g:i A', strtotime($bedAssign->assign_date)) }}</td>
            <td>{{ !empty($bedAssign->discharge_date) ? date('jS M, Y h:i:s A', strtotime($bedAssign->discharge_date)) : __('messages.common.n/a') }}</td>
            <td>{!! !empty($bedAssign->description) ? nl2br(e($bedAssign->description)) : __('messages.common.n/a') !!}</td>
            <td>{{ ($bedAssign->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
