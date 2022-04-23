<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.vaccination.name') }}</th>
        <th>{{ __('messages.vaccination.manufactured_by') }}</th>
        <th>{{ __('messages.vaccination.brand') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vaccinations as $vaccination)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $vaccination->name }}</td>
            <td>{{ $vaccination->manufactured_by }}</td>
            <td>{{ $vaccination->brand }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
