<?php

namespace App\Exports;

use App\Models\ChargeCategory;
use App\Models\DoctorOPDCharge;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class DoctorOPDChargeExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        return view('exports.receptionists.doctor_opd_charges',
            ['doctorOPDCharges' => DoctorOPDCharge::with('doctor.user')->get()]);
    }

    public function title(): string
    {
        return 'Doctor OPD Charges';
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
