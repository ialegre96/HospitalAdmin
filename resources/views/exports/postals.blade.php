<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ $result['type'] == \App\Models\Postal::POSTAL_RECEIVE ? __('messages.postal.from_title') : __('messages.postal.to_title') }}</th>
        <th>{{ __('messages.postal.reference_no') }}</th>
        <th>{{ $result['type'] == \App\Models\Postal::POSTAL_RECEIVE ? __('messages.postal.to_title') : __('messages.postal.from_title')  }}</th>
        <th>{{ __('messages.postal.date') }}</th>
        <th>{{ __('messages.postal.address') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($result['data'] as $show)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $result['type'] == \App\Models\Postal::POSTAL_RECEIVE ? $show->from_title : $show->to_title }}</td>
            <td>{{ $show->reference_no }}</td>
            <td>{{ $result['type'] == \App\Models\Postal::POSTAL_RECEIVE ? $show->to_title : $show->from_title }}</td>
            <td>{{ $show->date }}</td>
            <td>{{ $show->address }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
