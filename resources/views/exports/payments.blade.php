<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.payment.payment_date') }}</th>
        <th>{{ __('messages.payment.account_name') }}</th>
        <th>{{ __('messages.payment.pay_to') }}</th>
        <th>{{ __('messages.payment.amount') }}</th>
        <th>{{ __('messages.payment.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('jS M, Y', strtotime($payment->payment_date)) }}</td>
            <td>{{ $payment->account->name }}</td>
            <td>{{ $payment->pay_to }}</td>
            <td>{{ number_format($payment->amount, 2) }}</td>
            <td>{{ $payment->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
