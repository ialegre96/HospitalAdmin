<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.package.service') }}</th>
        <th>{{ __('messages.service.quantity') }}</th>
        <th>{{ __('messages.service.rate') }}</th>
        <th>{{ __('messages.common.status') }}</th>
        <th>{{ __('messages.common.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($services as $service)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->quantity }}</td>
            <td>{{ number_format($service->rate,2) }}</td>
            <td>{{ ($service->status == 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
            <td>{!! !empty($service->description) ? nl2br(e($service->description)) : __('messages.common.n/a') !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
