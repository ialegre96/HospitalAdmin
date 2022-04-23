<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.incomes.name') }}</th>
        <th>{{ __('messages.incomes.income_head') }}</th>
        <th>{{ __('messages.incomes.invoice_number') }}</th>
        <th>{{ __('messages.incomes.date') }}</th>
        <th>{{ __('messages.incomes.amount') }}</th>
        <th>{{ __('messages.incomes.description') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($incomes as $income)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $income->name }}</td>
            <td>{{ $incomeHead[$income->income_head] }}</td>
            <td>{{ !empty($income->invoice_number) ? $income->invoice_number : __('messages.common.n/a') }}</td>
            <td>{{ date('jS M, Y', strtotime($income->date)) }}</td>
            <td>{{ number_format($income->amount, 2) }}</td>
            <td>{{ $income->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
