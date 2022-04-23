<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.blood_donation.donor_name') }}</th>
        <th>{{ __('messages.blood_donation.bags') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bloodDonations as $bloodDonation)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bloodDonation->blooddonor->name }}</td>
            <td>{{ $bloodDonation->bags }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
