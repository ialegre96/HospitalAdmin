<?php

namespace App\Exports;

use App\Models\Prescription;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class PrescriptionExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        if (getLoggedInUser()->hasRole('Pharmacist')){
            $prescriptions = Prescription::with(['patient', 'doctor'])->where('status', Prescription::ACTIVE)->get();
        }else {
            $prescriptions = Prescription::with(['patient', 'doctor'])->where('patient_id',
                getLoggedInUser()->owner_id)->get();
        }
        return view('exports.patients.prescriptions',
            [
                'prescriptions' => $prescriptions,
            ]);
    }

    public function title(): string
    {
        if (getLoggedInUser()->hasRole('Pharmacist')){
            return 'Prescriptions';
        }
        
        return 'Patient Prescriptions';
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
