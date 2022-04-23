<?php

namespace App\Exports;

use App\Models\Package;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class PackageExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        return view('exports.receptionists.packages', ['packages' => Package::with('packageServicesItems')->get()]);
    }

    public function title(): string
    {
        return 'Packages';
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
