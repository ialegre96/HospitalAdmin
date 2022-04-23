<?php

namespace App\Exports;

use App\Models\EmployeePayroll;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class UserPayrollExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        $employeePayrolls = EmployeePayroll::with('owner.user')->where('owner_id',
            getLoggedInUser()->owner_id)->where('owner_type', getLoggedInUser()->owner_type)->get();

        return view('exports.accountants.employee_payrolls', ['employeePayrolls' => $employeePayrolls]);
    }

    public function title(): string
    {
        return 'Employee Payrolls';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
