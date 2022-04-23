<?php

namespace App\Exports;

use App\Models\Postal;
use Closure;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Route;

/**
 * Class PostalExport
 */
class PostalExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    /**
     * @return View
     */
    public function view(): View
    {
        $result = null;

        if (Route::current()->getName() == 'dispatches.excel') {
            $result['data'] = Postal::where('type', '=', Postal::POSTAL_DISPATCH)->get();
            $result['type'] = Postal::POSTAL_DISPATCH;
        }

        if (Route::current()->getName() == 'receives.excel') {
            $result['data'] = Postal::where('type', '=', Postal::POSTAL_RECEIVE)->get();
            $result['type'] = Postal::POSTAL_RECEIVE;
        }

        return view('exports.postals', ['result' => $result]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        if (Route::current()->getName() == 'dispatches.excel') {
            return 'Dispatch';
        }

        if (Route::current()->getName() == 'receives.excel') {
            return 'Receive';
        }
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
