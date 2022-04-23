<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.charge_category.charge_type') }}</th>
        <th>{{ __('messages.charge.charge_category') }}</th>
        <th>{{ __('messages.charge.code') }}</th>
        <th>{{ __('messages.charge.standard_charge') }}</th>
        <th>{{ __('messages.death_report.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($charges as $charge)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $chargeTypes[$charge->charge_type] }}</td>
            <td>{{ $charge->chargeCategory->name }}</td>
            <td>{{ $charge->code }}</td>
            <td>{{ number_format($charge->standard_charge, 0) }}</td>
            <td>{!! !empty($charge->description) ? nl2br(e($charge->description)) : __('messages.common.n/a') !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
