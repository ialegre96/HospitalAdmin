<?php

namespace App\Exports;

use App\Models\VaccinatedPatients;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class VaccinatedPatientExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        $vaccinatedPatients = VaccinatedPatients::with('patient.user','vaccination')->get();

        return view('exports.vaccinated_patients', ['vaccinatedPatients' => $vaccinatedPatients]);
    }

    public function title(): string
    {
        return 'VaccinatedPatient';
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
