<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.package.package') }}</th>
        <th>{{ __('messages.package.discount') }}</th>
        <th>{{ __('messages.package.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($packages as $package)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $package->name }}</td>
            <td>{{ $package->discount }}</td>
            <td>{!! !empty($package->description) ? nl2br(e($package->description)) : __('messages.common.n/a')  !!}</td>
        </tr>
        <tr></tr>
        <tr>
            <td>
                <table>
                    <thead>
                    <tr>
                        <th>{{ __('messages.common.no') }}</th>
                        <th>{{ __('messages.package.service') }}</th>
                        <th>{{ __('messages.package.qty') }}</th>
                        <th>{{ __('messages.package.rate') }}</th>
                        <th>{{ __('messages.package.amount') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($package->packageServicesItems as $packageServicesItem)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $packageServicesItem->service->name }}</td>
                            <td>{{ $packageServicesItem->quantity }}</td>
                            <td>{{ number_format($packageServicesItem->rate) }}</td>
                            <td>{{ number_format($packageServicesItem->amount) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
