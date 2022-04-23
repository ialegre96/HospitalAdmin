<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.account.type') }}</th>
        <th>{{ __('messages.payment.payment_date') }}</th>
        <th>{{ __('messages.payment.account_name') }}</th>
        <th>{{ __('messages.payment.pay_to') }}</th>
        <th>{{ __('messages.payment.amount') }}</th>
        <th>{{ __('messages.payment.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($paymentsReports as $paymentsReport)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ ($paymentsReport->accounts->type == 1) ? 'Debit' : 'Credit' }}</td>
            <td>{{ date('jS M, Y', strtotime($paymentsReport->payment_date)) }}</td>
            <td>{{ $paymentsReport->account->name }}</td>
            <td>{{ $paymentsReport->pay_to }}</td>
            <td>{{ number_format($paymentsReport->amount, 2) }}</td>
            <td>{{ $paymentsReport->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
