<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.call_log.name') }}</th>
        <th>{{ __('messages.call_log.phone') }}</th>
        <th>{{ __('messages.call_log.received_on') }}</th>
        <th>{{ __('messages.call_log.follow_up_date') }}</th>
        <th>{{ __('messages.call_log.call_type') }}</th>
        <th>{{ __('messages.call_log.note') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($callLogs as $callLog)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $callLog->name }}</td>
            <td>{{ $callLog->phone }}</td>
            <td>{{ $callLog->date }}</td>
            <td>{{ $callLog->follow_up_date }}</td>
            <td>{{ ($callLog->call_type) == \App\Models\CallLog::INCOMING ?  __('messages.call_log.incoming') : __('messages.call_log.outgoing') }}</td>
            <td>{{ $callLog->note }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
