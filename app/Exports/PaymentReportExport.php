<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class PaymentReportExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        $paymentReports = Payment::with('accounts')->get();

        return view('exports.payments_reports', ['paymentsReports' => Payment::with('accounts')->get()]);
    }

    public function title(): string
    {
        return 'Payment Reports';
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
