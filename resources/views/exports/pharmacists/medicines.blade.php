<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.medicine.medicine') }}</th>
        <th>{{ __('messages.medicine.brand') }}</th>
        <th>{{ __('messages.medicine.category') }}</th>
        <th>{{ __('messages.medicine.salt_composition') }}</th>
        <th>{{ __('messages.medicine.selling_price') }}</th>
        <th>{{ __('messages.medicine.buying_price') }}</th>
        <th>{{ __('messages.medicine.side_effects') }}</th>
        <th>{{ __('messages.medicine.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($medicines as $medicine)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $medicine->name }}</td>
            <td>{{ $medicine->brand->name }}</td>
            <td>{{ $medicine->category->name }}</td>
            <td>{{ $medicine->salt_composition }}</td>
            <td>{{ number_format($medicine->selling_price, 2) }}</td>
            <td>{{ number_format($medicine->buying_price, 2) }}</td>
            <td>{!! !empty($medicine->side_effects) ? nl2br(e($medicine->side_effects)) : __('messages.common.n/a') !!}</td>
            <td>{!! !empty($medicine->description) ? nl2br(e($medicine->description)) : __('messages.common.n/a') !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
