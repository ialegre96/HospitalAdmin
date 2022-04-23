<?php

namespace App\Exports;

use App\Models\Ambulance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class AmbulanceExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        $type = Ambulance::$vehicleType;

        return view('exports.ambulances', ['ambulances' => Ambulance::all(), 'type' => $type]);
    }

    public function title(): string
    {
        return 'Ambulances';
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
