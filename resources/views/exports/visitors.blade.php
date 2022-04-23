<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.visitor.purpose') }}</th>
        <th>{{ __('messages.visitor.name') }}</th>
        <th>{{ __('messages.visitor.phone') }}</th>
        <th>{{ __('messages.visitor.id_card') }}</th>
        <th>{{ __('messages.visitor.number_of_person') }}</th>
        <th>{{ __('messages.visitor.date') }}</th>
        <th>{{ __('messages.visitor.in_time') }}</th>
        <th>{{ __('messages.visitor.out_time') }}</th>
        <th>{{ __('messages.visitor.note') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($visitors as $visitor)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $visitorHead[$visitor->purpose]}}</td>
            <td>{{ $visitor->name }}</td>
            <td>{{ $visitor->phone }}</td>
            <td>{{ $visitor->id_card }}</td>
            <td>{{ $visitor->no_of_person }}</td>
            <td>{{ $visitor->date }}</td>
            <td>{{ $visitor->in_time }}</td>
            <td>{{ $visitor->out_time }}</td>
            <td>{{ $visitor->note }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
