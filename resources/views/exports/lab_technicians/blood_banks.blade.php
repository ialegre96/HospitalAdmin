<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.hospital_blood_bank.blood_group') }}</th>
        <th>{{ __('messages.hospital_blood_bank.remained_bags') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bloodBanks as $bloodBank)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bloodBank->blood_group }}</td>
            <td>{{ $bloodBank->remained_bags }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
