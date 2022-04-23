<?php

namespace App\Exports;

use App\Models\BloodDonation;
use Closure;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

/**
 * Class BloodDonationExport
 */
class BloodDonationExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    /**
     * @return View
     */
    public function view(): View
    {
        return view('exports.lab_technicians.blood_donations', ['bloodDonations' => BloodDonation::all()]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Blood Donations';
    }

    /**
     * @return Closure[]
     */
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
