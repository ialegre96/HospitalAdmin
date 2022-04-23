<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.medicine.brand') }}</th>
        <th>{{ __('messages.user.email') }}</th>
        <th>{{ __('messages.user.phone') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($brands as $brand)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $brand->name }}</td>
            <td>{{ !empty($brand->email) ? $brand->email : __('messages.common.n/a') }}</td>
            <td>{{ !empty($brand->phone) ? $brand->phone : __('messages.common.n/a') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
