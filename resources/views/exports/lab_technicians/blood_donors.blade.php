<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.blood_donor.name') }}</th>
        <th>{{ __('messages.blood_donor.age') }}</th>
        <th>{{ __('messages.user.gender') }}</th>
        <th>{{ __('messages.blood_donor.blood_group') }}</th>
        <th>{{ __('messages.blood_donor.last_donation_date') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bloodDonors as $bloodDonor)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bloodDonor->name }}</td>
            <td>{{ $bloodDonor->age }}</td>
            <td>{{ ($bloodDonor->gender === 0) ? __('messages.user.male') : __('messages.user.female') }}</td>
            <td>{{ $bloodDonor->blood_group }}</td>
            <td>{{ date('jS M, Y', strtotime($bloodDonor->last_donate_date)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
