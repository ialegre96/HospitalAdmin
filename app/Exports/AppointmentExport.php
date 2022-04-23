<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\User;
use Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class AppointmentExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        $appointments = Appointment::with(['patient', 'doctor', 'department']);
        if (getLoggedInUser()->hasRole('Doctor')) {
            $appointments->where('doctor_id', getLoggedInUser()->owner_id);
        }

        if (getLoggedInUser()->hasRole('Patient')) {
            $appointments->where('patient_id', getLoggedInUser()->owner_id);
        }

        return view('exports.patients.appointments',
            ['appointments' => $appointments->get()]);
    }

    public function title(): string
    {
        return 'Patient Appointments';
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
