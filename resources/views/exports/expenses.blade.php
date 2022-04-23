<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.expense.name') }}</th>
        <th>{{ __('messages.expense.income_head') }}</th>
        <th>{{ __('messages.expense.invoice_number') }}</th>
        <th>{{ __('messages.expense.date') }}</th>
        <th>{{ __('messages.expense.amount') }}</th>
        <th>{{ __('messages.expense.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expenses as $expense)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $expense->name }}</td>
            <td>{{ $expenseHead[$expense->expense_head] }}</td>
            <td>{{ !empty($expense->invoice_number) ? $expense->invoice_number : __('messages.common.n/a') }}</td>
            <td>{{ date('jS M, Y', strtotime($expense->date)) }}</td>
            <td>{{ number_format($expense->amount, 2) }}</td>
            <td>{{ $expense->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
