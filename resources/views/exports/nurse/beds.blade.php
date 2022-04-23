<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.bed_assign.bed') }}</th>
        <th>{{ __('messages.bed.bed_type') }}</th>
        <th>{{ __('messages.bed.bed_id') }}</th>
        <th>{{ __('messages.bed.charge') }}</th>
        <th>{{ __('messages.bed.available') }}</th>
        <th>{{ __('messages.bed.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($beds as $bed)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bed->name }}</td>
            <td>{{ $bed->bedType->title }}</td>
            <td>{{ $bed->bed_id }}</td>
            <td>{{ number_format($bed->charge,2) }}</td>
            <td>{{ ($bed->is_available) ? __('messages.common.yes') : __('messages.common.no') }}</td>
            <td>{!! !empty($bed->description) ? nl2br(e($bed->description)) : __('messages.common.n/a') !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
