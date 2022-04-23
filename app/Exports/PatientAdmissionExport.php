<?php

namespace App\Exports;

use App\Models\PatientAdmission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class PatientAdmissionExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        $query = PatientAdmission::with('patient.user', 'doctor.user', 'package', 'insurance');
        if (getLoggedInUser()->hasRole('Doctor')) {
            $query->where('doctor_id', getLoggedInUser()->owner_id);
        }

        return view('exports.doctors.patient_admissions', [
            'patientAdmissions' => $query->get(),
        ]);
    }

    public function title(): string
    {
        return 'Patient Admissions';
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
