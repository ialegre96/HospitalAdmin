<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.employee_payroll.sr_no') }}</th>
        <th>{{ __('messages.employee_payroll.payroll_id') }}</th>
        <th>{{ __('messages.employee_payroll.role') }}</th>
        <th>{{ __('messages.employee_payroll.employee') }}</th>
        <th>{{ __('messages.employee_payroll.month') }}</th>
        <th>{{ __('messages.employee_payroll.year') }}</th>
        <th>{{ __('messages.common.status') }}</th>
        <th>{{ __('messages.employee_payroll.basic_salary') }}</th>
        <th>{{ __('messages.employee_payroll.allowance') }}</th>
        <th>{{ __('messages.employee_payroll.deductions') }}</th>
        <th>{{ __('messages.employee_payroll.net_salary') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employeePayrolls as $employeePayroll)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $employeePayroll->sr_no }}</td>
            <td>{{ $employeePayroll->payroll_id }}</td>
            <td>{{ $employeePayroll->type_string }}</td>
            <td>{{ !empty($employeePayroll->owner->user->full_name) ? $employeePayroll->owner->user->full_name : ''}}</td>
            <td>{{ $employeePayroll->month }}</td>
            <td>{{ $employeePayroll->year }}</td>
            <td>{{ ($employeePayroll->status == 0) ? __('messages.invoice.not_paid') : __('messages.invoice.paid') }}</td>
            <td>{{ number_format($employeePayroll->basic_salary, 2) }}</td>
            <td>{{ number_format($employeePayroll->allowance, 2) }}</td>
            <td>{{ number_format($employeePayroll->deductions, 2) }}</td>
            <td>{{ number_format($employeePayroll->net_salary, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
