<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.blood_issue.issue_date') }}</th>
        <th>{{ __('messages.blood_issue.doctor_name') }}</th>
        <th>{{ __('messages.blood_issue.patient_name') }}</th>
        <th>{{ __('messages.blood_issue.donor_name') }}</th>
        <th>{{ __('messages.user.blood_group') }}</th>
        <th>{{ __('messages.blood_issue.amount') }}</th>
        <th>{{ __('messages.blood_issue.remarks') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bloodIssues as $bloodIssue)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('jS M, Y', strtotime($bloodIssue->issue_date)) }}</td>
            <td>{{ $bloodIssue->doctor->user->full_name }}</td>
            <td>{{ $bloodIssue->patient->user->full_name }}</td>
            <td>{{ $bloodIssue->blooddonor->name }}</td>
            <td>{{ $bloodIssue->blooddonor->blood_group }}</td>
            <td>{{ $bloodIssue->amount }}</td>
            <td>{{ $bloodIssue->remarks }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
